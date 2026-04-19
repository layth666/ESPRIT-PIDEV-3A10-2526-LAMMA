<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Entity\Delivery;
use App\Entity\Equipements;
use App\Entity\User;
use App\Form\DeliveryType;
use App\Form\EquipementsType;
use App\Repository\EquipementsRepository;
use App\Repository\UserRepository;
use App\Service\EquipementsVueService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\DeliveryCostAiEstimator;
class BoutiqueController extends AbstractController
{
    public function __construct(
        private readonly EquipementsRepository $equipementRepository,
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $em,
        private readonly EquipementsVueService $equipementVueService,
        private readonly MailerInterface $mailer,
    ) {
    }

    #[Route('/store', name: 'app_store')]
    public function storeAlias(): Response
    {
        return $this->redirectToRoute('app_boutique');
    }

    #[Route('/boutique/recherche', name: 'app_boutique_search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        $all = $this->equipementRepository->findAllOrderedByDateDesc();
        $qRaw = trim($request->query->getString('q'));
        $cat = $request->query->getString('categorie');
        $catFilter = $cat === '' || strcasecmp($cat, 'Toutes catégories') === 0 ? null : $cat;

        $filtered = $this->filterEquipements($all, $qRaw, $catFilter);
        $filtered = $this->orderEquipementsForDisplay($filtered, $catFilter);
        $viewsCount = $this->buildViewsCountForList($filtered);

        $html = $this->renderView('boutique/_cards.html.twig', [
            'equipements' => $filtered,
            'views_count' => $viewsCount,
        ]);

        return new JsonResponse([
            'html' => $html,
            'count' => \count($filtered),
        ]);
    }

    #[Route('/boutique', name: 'app_boutique', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $currentUser = $this->getUser();

        $all = $this->equipementRepository->findAllOrderedByDateDesc();
        $qRaw = trim($request->query->getString('q'));
        $cat = $request->query->getString('categorie');
        $catFilter = $cat === '' || strcasecmp($cat, 'Toutes catégories') === 0 ? null : $cat;

        $categories = $this->collectCategories($all);
        array_unshift($categories, 'Toutes catégories');

        $filtered = $this->filterEquipements($all, $qRaw, $catFilter);
        // Filtrer pour ne montrer que les équipements non livrés ou appartenant à l'utilisateur
        $filtered = array_filter($filtered, function (Equipements $e) use ($currentUser) {
            if ($e->getDelivery() && $e->getDelivery()->getStatut() === 'livree') {
                return $e->getOwner() === $currentUser;
            }
            return true;
        });
        $filtered = $this->orderEquipementsForDisplay($filtered, $catFilter);

        $viewsCount = $this->buildViewsCountForList($filtered);

        // Ensure user1 and user2 exist
        $this->ensureTestUsersExist();

        $form = null;
        if ($currentUser) {
            $equipement = new Equipements();
            $equipement->setOwner($currentUser);
            $form = $this->createForm(EquipementsType::class, $equipement);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $equipement->setDateAjout(new \DateTimeImmutable());
                $equipement->setStatut($equipement->getStatut() ?: 'DISPONIBLE');
                $delivery = $equipement->getDelivery();
                if ($delivery) {
                    $delivery->setEquipement($equipement);
                }
                $this->em->persist($equipement);
                $this->em->flush();

                $this->maybeSendNotificationEmail($equipement, $equipement->getMail());

                $this->addFlash('success', 'Équipement ajouté !');

                return $this->redirectToRoute('app_boutique');
            }
        }

        return $this->render('boutique/index.html.twig', [
            'equipements' => $filtered,
            'categories' => $categories,
            'current_categorie' => $catFilter ?? 'Toutes catégories',
            'q' => $qRaw,
            'views_count' => $viewsCount,
            'current_user' => $currentUser,
            'users' => $this->userRepository->findBy([], ['userid' => 'ASC']),
            'livraisons' => $currentUser ? $currentUser->getLivraisons() : [],
            'form' => $form,
        ]);
    }


    #[Route('/mes-livraisons', name: 'app_my_deliveries')]
    public function myDeliveries(): Response
    {
        $currentUser = $this->getUser();

        if (!$currentUser) {
            $this->addFlash('error', 'Veuillez vous connecter.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('boutique/my_deliveries.html.twig', [
            'livraisons' => $currentUser->getLivraisons(),
        ]);
    }

    #[Route('/boutique/{id}/commander', name: 'app_boutique_order', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function order(Request $request, string $id): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        if (!$equipement->isLivrable()) {
            $this->addFlash('error', 'Cet équipement n\'est pas livrable.');
            return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
        }

        if ($equipement->getDelivery()) {
            $this->addFlash('error', 'Une commande est déjà enregistrée pour cet équipement.');
            return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
        }

        $currentUser = $this->getUser();

        if (!$currentUser) {
            $this->addFlash('error', 'Veuillez vous connecter pour commander.');
            return $this->redirectToRoute('app_login');
        }

        // Vérifier que l'utilisateur n'est pas le propriétaire
        $isOwner = false;
        if ($equipement->getOwner()) {
            $isOwner = ($equipement->getOwner()->getId() === $currentUser->getId());
        }
        
        if ($isOwner) {
            $this->addFlash('error', 'Vous ne pouvez pas commander votre propre équipement.');
            return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
        }

        $token = $request->request->getString('_token');
        if (!$this->isCsrfTokenValid('order_equipement_' . $id, $token)) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $delivery = new Delivery();
        $delivery->setEquipement($equipement);
        $delivery->setAcheteur($currentUser);
        $delivery->setStatut('en_attente');

        $this->em->persist($delivery);
        $this->em->flush();

        $this->addFlash('success', 'Commande enregistrée. Complétez vos coordonnées de livraison.');

        return $this->redirectToRoute('app_boutique_delivery', ['id' => $id]);
    }

    #[Route('/boutique/{id}/livraison', name: 'app_boutique_delivery', requirements: ['id' => '\d+'])]
    public function delivery(Request $request, string $id): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUser = $this->getUser();
        if (!$currentUser) {
            $this->addFlash('error', 'Veuillez vous connecter.');
            return $this->redirectToRoute('app_login');
        }

        $delivery = $equipement->getDelivery();
        if (!$delivery) {
            $this->addFlash('error', 'Aucune livraison associée pour cet équipement.');
            return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
        }

        $isOwner = false;
        $isBuyer = false;
        
        if ($equipement->getOwner()) {
            $isOwner = ($equipement->getOwner()->getId() === $currentUser->getId());
        }
        if ($delivery->getAcheteur()) {
            $isBuyer = ($delivery->getAcheteur()->getId() === $currentUser->getId());
        }
        
        if (!$isOwner && !$isBuyer) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas accéder à cette livraison.');
        }

        $form = $this->createForm(DeliveryType::class, $delivery, [
            'status_editable' => $isOwner,
            'address_editable' => $isBuyer,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($isBuyer && !$delivery->getEstimation() && $delivery->getLatitude() && $delivery->getLongitude()) {
                // INTELLIGENCE ARTIFICIELLE : Estimation de livraison (Mock)
                // Logique basée sur les coordonnées (simulée ici par une complexité mathématique basique)
                $latTns = 36.8065; // Latitude centre Tunis (admin)
                $lngTns = 10.1815;
                
                // Calcul de distance euclidienne simplifiée
                $diffLat = abs($latTns - $delivery->getLatitude()) * 111; // 1 degré ≈ 111 km
                $diffLng = abs($lngTns - $delivery->getLongitude()) * 90; // Approx lng distance
                $distanceKm = sqrt($diffLat * $diffLat + $diffLng * $diffLng);
                
                // Météo et Trafic simulés
                $weatherPenalty = (int) date('H') % 3 === 0 ? 1 : 0; // 1 jour de +"pluie" factice
                $trafficPenalty = $distanceKm < 20 ? 1 : 0; // Bouchons locaux
                
                $daysToDeliver = max(1, ceil($distanceKm / 100)) + $weatherPenalty + $trafficPenalty;
                
                $delivery->setEstimation((new \DateTime())->modify('+' . $daysToDeliver . ' days'));
            }

            $this->em->flush();
            if ($isOwner) {
                $this->addFlash('success', 'État de livraison mis à jour.');
                return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
            }

            $this->addFlash('success', 'Coordonnées enregistrées. Veuillez procéder au paiement.');
            return $this->redirectToRoute('app_boutique_payment', ['id' => $id]);
        }

        return $this->render('boutique/delivery.html.twig', [
            'equipement' => $equipement,
            'delivery' => $delivery,
            'form' => $form->createView(),
            'isOwner' => $isOwner,
            'isBuyer' => $isBuyer,
        ]);
    }

    #[Route('/delivery/estimate-cost', name: 'app_delivery_estimate', methods: ['POST'])]
    public function estimateCost(Request $request, DeliveryCostAiEstimator $aiEstimator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $distanceKm = isset($data['distance_km']) ? (float)$data['distance_km'] : 0.0;

        if ($distanceKm <= 0) {
            return new JsonResponse(['error' => 'Invalid distance'], 400);
        }

        $estimation = $aiEstimator->estimate($distanceKm);

        return new JsonResponse($estimation);
    }

    #[Route('/boutique/{id}/paiement', name: 'app_boutique_payment', requirements: ['id' => '\d+'])]
    public function payment(string $id): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement || !$equipement->getDelivery()) {
            throw $this->createNotFoundException();
        }

        $currentUser = $this->getUser();
        
        $delivery = $equipement->getDelivery();
        $isBuyer = $currentUser && $delivery->getAcheteur() && ($delivery->getAcheteur()->getId() === $currentUser->getId());
        
        if (!$isBuyer) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas payer cette commande.');
        }

        return $this->render('boutique/payment.html.twig', [
            'equipement' => $equipement,
            'delivery' => $delivery,
        ]);
    }

    #[Route('/boutique/{id}/paiement/valider', name: 'app_boutique_payment_process', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function processPayment(Request $request, string $id): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement || !$equipement->getDelivery()) {
            throw $this->createNotFoundException();
        }
        
        $token = $request->request->getString('_token');
        if (!$this->isCsrfTokenValid('process_payment_'.$id, $token)) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $delivery = $equipement->getDelivery();
        $delivery->setStatut('preparation');
        
        // --- LOGIQUE METIER TRANSACTION (Mock) --- //
        $transaction = new Transaction();
        $transaction->setEquipement($equipement);
        
        // current buyer
        $currentUser = $this->getUser();
        if($currentUser) {
            $transaction->setBuyer($currentUser);
        } else {
            // Fallback
            $transaction->setBuyer($delivery->getAcheteur());
        }
        
        $transaction->setSeller($equipement->getOwner());
        
        // Calculate total price
        $frais = $delivery->getFraisLivraison() ?? 0.0;
        $totalPrice = (float) $equipement->getPrix() + $frais;
        $transaction->setPrice((string)$totalPrice);
        
        $transaction->setStripeToken('mock_token_' . bin2hex(random_bytes(8)));
        
        $this->em->persist($transaction);
        $equipement->setStatut('VENDU');

        $this->em->flush();

        $this->addFlash('success', 'Paiement effectué avec succès. Votre commande est en préparation.');
        return $this->redirectToRoute('app_my_deliveries');
    }

    #[Route('/boutique/nouveau', name: 'app_boutique_new')]
    public function new(Request $request): Response
    {
        $currentUser = $this->getUser();

        if (!$currentUser) {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un équipement.');
            return $this->redirectToRoute('app_login');
        }

        $equipement = new Equipements();
        $equipement->setOwner($currentUser);
        $form = $this->createForm(EquipementsType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipement->setDateAjout(new \DateTimeImmutable());
            $equipement->setStatut($equipement->getStatut() ?: 'DISPONIBLE');
            $delivery = $equipement->getDelivery();
            if ($delivery) {
                $delivery->setEquipement($equipement);
            }
            $this->em->persist($equipement);
            $this->em->flush();

            $this->maybeSendNotificationEmail($equipement, $equipement->getMail());

            $this->addFlash('success', 'Équipement ajouté !');

            return $this->redirectToRoute('app_boutique');
        }

        return $this->render('boutique/form.html.twig', [
            'form' => $form,
            'title' => 'Nouvel équipement (Boutique)',
            'current_user' => $currentUser,
            'users' => $this->userRepository->findBy([], ['userid' => 'ASC']),
        ]);
    }

    #[Route('/boutique/{id}', name: 'app_boutique_show', requirements: ['id' => '\d+'])]
    public function show(string $id): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUser = $this->getUser();
        
        // Vérifier si l'utilisateur actuel est le propriétaire de l'équipement
        $isOwner = false;
        if ($currentUser && $equipement->getOwner()) {
            $isOwner = ($equipement->getOwner()->getId() === $currentUser->getId());
        }
        
        $delivery = $equipement->getDelivery();
        $isBuyer = $currentUser && $delivery && $delivery->getAcheteur() && ($delivery->getAcheteur()->getId() === $currentUser->getId());
        $canOrder = $currentUser && !$isOwner && $equipement->isLivrable() && !$delivery;
        $canViewDelivery = $currentUser && $delivery && ($isBuyer || $isOwner);

        return $this->render('boutique/show.html.twig', [
            'equipement' => $equipement,
            'views_count' => $this->equipementVueService->getViewsCount($equipement),
            'current_user' => $currentUser,
            'can_manage' => $isOwner,
            'is_buyer' => $isBuyer,
            'can_order' => $canOrder,
            'can_view_delivery' => $canViewDelivery,
        ]);
    }

    #[Route('/boutique/{id}/modifier', name: 'app_boutique_edit', requirements: ['id' => '\d+'])]
    public function edit(Request $request, string $id): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUser = $this->getUser();

        // Vérifier que l'utilisateur est le propriétaire
        $isOwner = false;
        if ($equipement->getOwner() && $currentUser) {
            $isOwner = ($equipement->getOwner()->getId() === $currentUser->getId());
        }
        
        if (!$isOwner) {
            throw $this->createAccessDeniedException('Vous ne pouvez modifier que vos équipements.');
        }

        $form = $this->createForm(EquipementsType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $delivery = $equipement->getDelivery();
            if ($delivery) {
                $delivery->setEquipement($equipement);
            }
            $this->em->flush();

            $this->addFlash('success', 'Équipement modifié !');

            return $this->redirectToRoute('app_boutique');
        }

        return $this->render('boutique/form.html.twig', [
            'form' => $form,
            'title' => 'Modifier équipement',
            'equipement' => $equipement,
            'current_user' => $currentUser,
            'users' => $this->userRepository->findBy([], ['userid' => 'ASC']),
        ]);
    }

    #[Route('/boutique/{id}/supprimer', name: 'app_boutique_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, string $id): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUser = $this->getUser();

        // Vérifier que l'utilisateur est le propriétaire
        $isOwner = false;
        if ($equipement->getOwner() && $currentUser) {
            $isOwner = ($equipement->getOwner()->getId() === $currentUser->getId());
        }
        
        if (!$isOwner) {
            throw $this->createAccessDeniedException('Vous ne pouvez supprimer que vos équipements.');
        }

        $token = $request->request->getString('_token');
        if (!$this->isCsrfTokenValid('delete_equipement_'.$id, $token)) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $this->em->remove($equipement);
        $this->em->flush();
        $this->addFlash('success', 'Équipement supprimé.');

        return $this->redirectToRoute('app_boutique');
    }

    private function ensureTestUsersExist(): void
    {
        $testUserIds = ['user1', 'user2'];
        foreach ($testUserIds as $userid) {
            $user = $this->userRepository->findOneBy(['userid' => $userid]);
            if (!$user) {
                $user = new User();
                $user->setUserid($userid);
                $user->setNom(ucfirst($userid));
                $user->setEmail($userid . '@lamma.tn');
                $user->setPassword('test123'); // Plain password since security is disabled
                $this->em->persist($user);
            }
            // Always set roles
            $user->setRoles($userid === 'user1' ? ['ROLE_ADMIN'] : ['ROLE_USER']);
            $this->em->persist($user);
        }
        $this->em->flush();
    }

    /**
     * @param list<Equipements> $all
     *
     * @return list<Equipements>
     */
    private function filterEquipements(array $all, string $qRaw, ?string $catFilter): array
    {
        return array_values(array_filter($all, function (Equipements $e) use ($qRaw, $catFilter) {
            $matchSearch = $this->matchesIntelligentSearch($e, $qRaw);

            $matchCat = $catFilter === null
                || $this->equipmentCategoryMatchesFilter($e->getCategorie(), $catFilter);

            return $matchSearch && $matchCat;
        }));
    }

    /**
     * Comparaison tolérante (casse / espaces) entre la catégorie en base et le filtre.
     */
    private function equipmentCategoryMatchesFilter(?string $entityCategorie, string $filterCat): bool
    {
        if ($entityCategorie === null || trim($entityCategorie) === '') {
            return false;
        }

        return strcasecmp(trim($entityCategorie), trim($filterCat)) === 0;
    }

    /**
     * Tri : par catégorie puis nom si « Toutes catégories », sinon par nom uniquement.
     *
     * @param list<Equipements> $list
     *
     * @return list<Equipements>
     */
    private function orderEquipementsForDisplay(array $list, ?string $catFilter): array
    {
        usort($list, function (Equipements $a, Equipements $b) use ($catFilter) {
            if ($catFilter === null) {
                $ca = mb_strtolower($a->getCategorie() ?? '', 'UTF-8');
                $cb = mb_strtolower($b->getCategorie() ?? '', 'UTF-8');
                if ($ca !== $cb) {
                    return $ca <=> $cb;
                }
            }
            $na = mb_strtolower($a->getNom() ?? '', 'UTF-8');
            $nb = mb_strtolower($b->getNom() ?? '', 'UTF-8');

            return $na <=> $nb;
        });

        return $list;
    }

    /**
     * @param list<Equipement> $equipements
     *
     * @return array<string, int>
     */
    private function buildViewsCountForList(array $equipements): array
    {
        $viewsCount = [];
        foreach ($equipements as $e) {
            $viewsCount[$e->getId()] = $this->equipementVueService->getViewsCount($e);
        }

        return $viewsCount;
    }

    /**
     * Recherche « intelligente » : plusieurs mots (ET), insensible à la casse,
     * champs combinés (nom, description, catégorie, ville, type, statut, prix, mail),
     * accents approximativement neutralisés.
     */
    private function matchesIntelligentSearch(Equipements $e, string $rawQuery): bool
    {
        $rawQuery = trim($rawQuery);
        if ($rawQuery === '') {
            return true;
        }

        $tokens = preg_split('/\s+/u', mb_strtolower($rawQuery, 'UTF-8')) ?: [];
        $tokens = array_values(array_filter($tokens, static fn ($t) => $t !== ''));
        if ($tokens === []) {
            return true;
        }

        $hayNorm = $this->normalizeForSearch($this->buildSearchHaystack($e));

        foreach ($tokens as $token) {
            $tokNorm = $this->normalizeForSearch($token);
            if ($tokNorm === '') {
                continue;
            }
            if (!str_contains($hayNorm, $tokNorm)) {
                return false;
            }
        }

        return true;
    }

    private function buildSearchHaystack(Equipements $e): string
    {
        $parts = [
            $e->getNom(),
            $e->getDescription(),
            $e->getCategorie(),
            $e->getVille(),
            $e->getType(),
            $e->getStatut(),
            $e->getPrix(),
            $e->getMail(),
            $e->getCaracteristiques(),
        ];

        foreach ($e->getAttributs() as $attr) {
            $parts[] = $attr->getNomAttribut();
            $parts[] = $attr->getValeur();
        }

        return implode(' ', array_map(static fn ($p) => $p !== null && $p !== '' ? (string) $p : '', $parts));
    }

    private function normalizeForSearch(string $s): string
    {
        $s = mb_strtolower($s, 'UTF-8');
        if (class_exists(\Normalizer::class)) {
            $d = \Normalizer::normalize($s, \Normalizer::FORM_D);
            if (\is_string($d)) {
                $s = preg_replace('/\p{Mn}/u', '', $d) ?? $s;
            }
        }
        $conv = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
        if (\is_string($conv) && $conv !== '') {
            $s = $conv;
        }

        return preg_replace('/\s+/u', ' ', $s) ?? $s;
    }

    /**
     * @param list<Equipement> $all
     *
     * @return list<string>
     */
    private function collectCategories(array $all): array
    {
        $set = [];
        foreach ($all as $e) {
            $c = $e->getCategorie();
            if ($c !== null && trim($c) !== '') {
                $set[mb_strtolower(trim($c))] = trim($c);
            }
        }
        $list = array_values($set);
        sort($list, SORT_STRING | SORT_FLAG_CASE);

        return $list;
    }

    private function maybeSendNotificationEmail(Equipements $e, mixed $to): void
    {
        if (!is_string($to) || trim($to) === '') {
            return;
        }

        try {
            $type = $e->getType() ?? '';
            $prix = $e->getPrix() ?? '';
            $corps = sprintf(
                "L'équipement (%s) avec le prix %s TND a été ajouté avec succès.\n\nDétails :\n- Nom : %s\n- Catégorie : %s\n- Type : %s\n- Prix : %s TND\n- Ville : %s\n- Description : %s\n",
                $type,
                $prix,
                $e->getNom(),
                $e->getCategorie() ?? '-',
                $type,
                $prix,
                $e->getVille() ?? '-',
                $e->getDescription() ?? '-'
            );

            $email = (new Email())
                ->from('noreply@lamma.local')
                ->to(trim($to))
                ->subject('Équipement ajouté avec succès – LAMMA')
                ->text($corps);

            $this->mailer->send($email);
        } catch (\Throwable) {
            $this->addFlash('warning', 'L’e-mail de notification n’a pas pu être envoyé (vérifiez MAILER_DSN).');
        }
    }
}
