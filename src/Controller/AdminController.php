<?php

namespace App\Controller;

use App\Entity\Equipements;
use App\Form\EquipementsType;
use App\Repository\EquipementsRepository;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
 
#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    public function __construct(
        private readonly EquipementsRepository $equipementRepository,
        private readonly TransactionRepository $transactionRepository,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route('', name: 'app_admin')]
    public function index(Request $request): Response
    {

        $all = $this->equipementRepository->findAllOrderedByDateDesc();
        $qRaw = trim($request->query->getString('q'));
        $cat = $request->query->getString('categorie');
        $catFilter = $cat === '' || strcasecmp($cat, 'Toutes catégories') === 0 ? null : $cat;

        $categories = $this->collectCategories($all);
        array_unshift($categories, 'Toutes catégories');

        $equipements = $this->filterEquipements($all, $qRaw, $catFilter);
        $equipements = $this->orderEquipementsForDisplay($equipements, $catFilter);

        $livrableCount = count(array_filter($equipements, fn(Equipements $e): bool => $e->isLivrable()));
        $deliveryCount = count(array_filter($equipements, fn(Equipements $e): bool => $e->getDelivery() !== null));

        $transactions = $this->transactionRepository->findAllOrderedByDateDesc();

        return $this->render('admin/dashboard.html.twig', [
            'equipements' => $equipements,
            'total' => count($equipements),
            'livrable_count' => $livrableCount,
            'delivery_count' => $deliveryCount,
            'categories' => $categories,
            'current_categorie' => $catFilter ?? 'Toutes catégories',
            'q' => $qRaw,
            'transactions' => $transactions,
        ]);
    }

    #[Route('/admin/equipements/recherche', name: 'app_admin_search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {

        $all = $this->equipementRepository->findAllOrderedByDateDesc();
        $qRaw = trim($request->query->getString('q'));
        $cat = $request->query->getString('categorie');
        $catFilter = $cat === '' || strcasecmp($cat, 'Toutes catégories') === 0 ? null : $cat;

        $equipements = $this->filterEquipements($all, $qRaw, $catFilter);
        $equipements = $this->orderEquipementsForDisplay($equipements, $catFilter);

        $html = $this->renderView('admin/_equipement_rows.html.twig', [
            'equipements' => $equipements,
        ]);

        return new JsonResponse([
            'html' => $html,
            'count' => count($equipements),
        ]);
    }

    #[Route('/admin/equipements/{id}', name: 'app_admin_equipements_show', requirements: ['id' => '\d+'])]
    public function showEquipement(int $id): Response
    {

        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException('Équipement introuvable.');
        }

        return $this->render('admin/equipement_show.html.twig', [
            'equipement' => $equipement,
        ]);
    }

    #[Route('/admin/equipements/{id}/modifier', name: 'app_admin_equipements_edit', requirements: ['id' => '\d+'])]
    public function editEquipement(Request $request, int $id): Response
    {

        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException('Équipement introuvable.');
        }

        $form = $this->createForm(EquipementsType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $delivery = $equipement->getDelivery();
            if ($delivery) {
                $delivery->setEquipement($equipement);
            }

            $this->em->flush();
            $this->addFlash('success', 'Équipement modifié avec succès.');

            return $this->redirectToRoute('app_admin_equipements_show', ['id' => $equipement->getId()]);
        }

        return $this->render('admin/equipement_form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier équipement',
            'equipement' => $equipement,
        ]);
    }

    #[Route('/admin/equipements/{id}/supprimer', name: 'app_admin_equipements_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function deleteEquipement(Request $request, int $id): Response
    {

        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException('Équipement introuvable.');
        }

        $token = $request->request->getString('_token');
        if (!$this->isCsrfTokenValid('delete_equipement_'.$id, $token)) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $this->em->remove($equipement);
        $this->em->flush();

        $this->addFlash('success', 'Équipement supprimé.');

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/admin/add-user', name: 'app_admin_add_user')]
    public function addUser(): Response
    {

        return $this->render('admin/add-user.html.twig');
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

    private function equipmentCategoryMatchesFilter(?string $entityCategorie, string $filterCat): bool
    {
        if ($entityCategorie === null || trim($entityCategorie) === '') {
            return false;
        }

        $normalizedCategory = $this->normalizeForSearch(trim($entityCategorie));
        $normalizedFilter = $this->normalizeForSearch(trim($filterCat));

        if ($normalizedFilter === '') {
            return false;
        }

        return str_contains($normalizedCategory, $normalizedFilter);
    }

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

}
