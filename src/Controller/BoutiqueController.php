<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Entity\Equipement;
use App\Entity\User;
use App\Form\DeliveryType;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use App\Repository\UserRepository;
use App\Service\EquipementVueService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
class BoutiqueController extends AbstractController
{
    public function __construct(
        private readonly EquipementRepository $equipementRepository,
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $em,
        private readonly EquipementVueService $equipementVueService,
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

    #[Route('/boutique', name: 'app_boutique')]
    public function index(Request $request, SessionInterface $session): Response
    {
        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

        $all = $this->equipementRepository->findAllOrderedByDateDesc();
        $qRaw = trim($request->query->getString('q'));
        $cat = $request->query->getString('categorie');
        $catFilter = $cat === '' || strcasecmp($cat, 'Toutes catégories') === 0 ? null : $cat;

        $categories = $this->collectCategories($all);
        array_unshift($categories, 'Toutes catégories');

        $filtered = $this->filterEquipements($all, $qRaw, $catFilter);
        // Filtrer pour ne montrer que les équipements non livrés ou appartenant à l'utilisateur
        $filtered = array_filter($filtered, function (Equipement $e) use ($currentUser) {
            if ($e->getDelivery() && $e->getDelivery()->getStatut() === 'livree') {
                return $e->getOwner() === $currentUser;
            }
            return true;
        });
        $filtered = $this->orderEquipementsForDisplay($filtered, $catFilter);

        $viewsCount = $this->buildViewsCountForList($filtered);

        // Ensure user1 and user2 exist
        $this->ensureTestUsersExist();

        return $this->render('boutique/index.html.twig', [
            'equipements' => $filtered,
            'categories' => $categories,
            'current_categorie' => $catFilter ?? 'Toutes catégories',
            'q' => $qRaw,
            'views_count' => $viewsCount,
            'current_user' => $currentUser,
            'users' => $this->userRepository->findBy(['userid' => ['user1', 'user2']]),
        ]);
    }

    #[Route('/boutique/utilisateur', name: 'app_boutique_set_user', methods: ['POST'])]
    public function setCurrentUser(Request $request, SessionInterface $session): Response
    {
        if (!$this->isCsrfTokenValid('set_current_user', $request->request->getString('_token'))) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $userId = $request->request->getInt('user_id');
        if ($userId > 0) {
            $user = $this->userRepository->find($userId);
            if ($user) {
                $session->set('current_user_id', $userId);
                $session->set('current_user_name', $user->getUserid());
                $session->set('current_user_is_admin', in_array('ROLE_ADMIN', $user->getRoles(), true));
                $this->addFlash('success', 'Utilisateur défini : ' . $user->getUserid());
            }
        } else {
            $session->remove('current_user_id');
            $session->remove('current_user_name');
            $session->remove('current_user_is_admin');
            $this->addFlash('success', 'Utilisateur déconnecté.');
        }

        return $this->redirectToRoute('app_boutique');
    }

    #[Route('/boutique/utilisateur-vues', name: 'app_boutique_user', methods: ['POST'])]
    public function setBoutiqueUser(Request $request, SessionInterface $session): Response
    {
        if (!$this->isCsrfTokenValid('boutique_user', $request->request->getString('_token'))) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $uid = trim($request->request->getString('user_id'));
        if ($uid !== '') {
            $session->set('boutique_user_id', $uid);
            $this->addFlash('success', 'Identifiant enregistré pour le comptage des vues.');
        }

        return $this->redirectToRoute('app_boutique');
    }

    #[Route('/mes-livraisons', name: 'app_my_deliveries')]
    public function myDeliveries(SessionInterface $session): Response
    {
        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

        if (!$currentUser) {
            $this->addFlash('error', 'Veuillez vous connecter.');
            return $this->redirectToRoute('app_boutique');
        }

        return $this->render('boutique/my_deliveries.html.twig', [
            'livraisons' => $currentUser->getLivraisons(),
        ]);
    }

    #[Route('/boutique/{id}/commander', name: 'app_boutique_order', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function order(Request $request, string $id, SessionInterface $session): Response
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

        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

        if (!$currentUser) {
            $this->addFlash('error', 'Veuillez vous connecter pour commander.');
            return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
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
    public function delivery(Request $request, string $id, SessionInterface $session): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;
        if (!$currentUser) {
            $this->addFlash('error', 'Veuillez vous connecter.');
            return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
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
            $this->em->flush();
            if ($isOwner) {
                $this->addFlash('success', 'État de livraison mis à jour.');
                return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
            }

            $this->addFlash('success', 'Coordonnées de livraison enregistrées.');
            return $this->redirectToRoute('app_my_deliveries');
        }

        return $this->render('boutique/delivery.html.twig', [
            'equipement' => $equipement,
            'delivery' => $delivery,
            'form' => $form->createView(),
            'isOwner' => $isOwner,
            'isBuyer' => $isBuyer,
        ]);
    }

    #[Route('/boutique/nouveau', name: 'app_boutique_new')]
    public function new(Request $request, SessionInterface $session): Response
    {
        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

        if (!$currentUser) {
            $this->addFlash('error', 'Vous devez être connecté en tant qu’utilisateur pour ajouter un équipement.');
            return $this->redirectToRoute('app_boutique');
        }

        $equipement = new Equipement();
        $equipement->setOwner($currentUser);
        $form = $this->createForm(EquipementType::class, $equipement);
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
        ]);
    }

    #[Route('/boutique/{id}', name: 'app_boutique_show', requirements: ['id' => '\d+'])]
    public function show(string $id, SessionInterface $session): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $userId = $session->get('boutique_user_id');
        if (is_string($userId) && $userId !== '') {
            $this->equipementVueService->registerView($equipement, $userId);
        }

        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;
        
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
    public function edit(Request $request, string $id, SessionInterface $session): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

        // Vérifier que l'utilisateur est le propriétaire
        $isOwner = false;
        if ($equipement->getOwner() && $currentUser) {
            $isOwner = ($equipement->getOwner()->getId() === $currentUser->getId());
        }
        
        if (!$isOwner) {
            throw $this->createAccessDeniedException('Vous ne pouvez modifier que vos équipements.');
        }

        $form = $this->createForm(EquipementType::class, $equipement);
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
        ]);
    }

    #[Route('/boutique/{id}/supprimer', name: 'app_boutique_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, string $id, SessionInterface $session): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

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
            $user->setRoles($userid === 'user1' ? ['ROLE_ADMIN'] : []);
            $this->em->persist($user);
        }
        $this->em->flush();
    }

    /**
     * @param list<Equipement> $all
     *
     * @return list<Equipement>
     */
    private function filterEquipements(array $all, string $qRaw, ?string $catFilter): array
    {
        return array_values(array_filter($all, function (Equipement $e) use ($qRaw, $catFilter) {
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
     * @param list<Equipement> $list
     *
     * @return list<Equipement>
     */
    private function orderEquipementsForDisplay(array $list, ?string $catFilter): array
    {
        usort($list, function (Equipement $a, Equipement $b) use ($catFilter) {
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
    private function matchesIntelligentSearch(Equipement $e, string $rawQuery): bool
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

    private function buildSearchHaystack(Equipement $e): string
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

    private function maybeSendNotificationEmail(Equipement $e, mixed $to): void
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
