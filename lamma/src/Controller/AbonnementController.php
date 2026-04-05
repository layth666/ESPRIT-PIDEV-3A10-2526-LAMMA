<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/abonnements')]
#[IsGranted('ROLE_USER')]
class AbonnementController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private AbonnementRepository $repository
    ) {}

    #[Route('', name: 'app_abonnement_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $qb = $this->repository->createQueryBuilder('a');
        
        // Data isolation: show only current user's records
        if (!$this->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            $qb->andWhere('a.userId = :currentUser')
               ->setParameter('currentUser', $user instanceof \App\Entity\User ? $user->getId() : 0);
        }

        return $this->render('abonnement/index.html.twig', [
            'items' => $qb->getQuery()->getResult(),
        ]);
    }

    #[Route('/nouveau', name: 'app_abonnement_new', methods: ['GET', 'POST'])]
    public function nouveau(Request $request): Response
    {
        $abonnement = new Abonnement();
        $form = $this->createForm(\App\Form\AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\User $userObj */
            $userObj = $this->getUser();
            $abonnement->setUserId($userObj instanceof \App\Entity\User ? $userObj->getId() : 0);
            
            $this->em->persist($abonnement);
            $this->em->flush();

            return $this->redirectToRoute('app_abonnement_index');
        }

        return $this->render('abonnement/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_abonnement_edit', methods: ['GET', 'POST'])]
    public function editWeb(int $id, Request $request): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', '⛔ Les administrateurs ne peuvent pas modifier les abonnements directement.');
            return $this->redirectToRoute('app_abonnement_show', ['id' => $id]);
        }
        $abonnement = $this->repository->find($id);
        if (!$abonnement) {
            throw $this->createNotFoundException('Abonnement non trouvé');
        }

        $form = $this->createForm(\App\Form\AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('app_abonnement_index');
        }

        return $this->render('abonnement/edit.html.twig', [
            'form' => $form->createView(),
            'abonnement' => $abonnement,
        ]);
    }

    #[Route('/{id}/details', name: 'app_abonnement_show', methods: ['GET'])]
    public function showWeb(int $id): Response
    {
        $abonnement = $this->repository->find($id);
        if (!$abonnement) {
            throw $this->createNotFoundException('Abonnement non trouvé');
        }

        return $this->render('abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }

    #[Route('/{id}/confirmer', name: 'app_abonnement_confirmer', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function confirmer(int $id): Response
    {
        $abonnement = $this->repository->find($id);
        if ($abonnement) {
            $abonnement->setStatut(Abonnement::STATUT_ACTIF);
            $this->em->flush();
            $this->addFlash('success', '✅ Abonnement activé avec succès.');
        }
        return $this->redirectToRoute('app_abonnement_show', ['id' => $id]);
    }

    #[Route('/{id}/suspendre', name: 'app_abonnement_suspendre', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function suspendre(int $id): Response
    {
        $abonnement = $this->repository->find($id);
        if ($abonnement) {
            $abonnement->setStatut(Abonnement::STATUT_SUSPENDU);
            $this->em->flush();
            $this->addFlash('success', '⏸ Abonnement suspendu.');
        }
        return $this->redirectToRoute('app_abonnement_show', ['id' => $id]);
    }

    #[Route('/{id}/delete/web', name: 'app_abonnement_delete', methods: ['POST'])]
    public function deleteWeb(int $id, Request $request): Response
    {
        $abonnement = $this->repository->find($id);
        if ($abonnement && $this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $this->em->remove($abonnement);
            $this->em->flush();
            $this->addFlash('success', 'Abonnement supprimé');
        }
        return $this->redirectToRoute('app_abonnement_index');
    }

    #[Route('/api/{id}', name: 'abonnement_get', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $abonnement = $this->repository->find($id);
        if (!$abonnement) return new JsonResponse(['error' => 'Abonnement non trouvé'], 404);

        return new JsonResponse($abonnement);
    }

    #[Route('/api/{id}', name: 'abonnement_delete_api', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $abonnement = $this->repository->find($id);
        if (!$abonnement) return new JsonResponse(['success' => false]);

        $this->em->remove($abonnement);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('', name: 'abonnement_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $abonnement = new Abonnement();

        // TODO: mapper les champs du JSON dans l'entité
        // ex: $abonnement->setStatut($data['statut'] ?? null);

        $this->em->persist($abonnement);
        $this->em->flush();

        return new JsonResponse($abonnement, 201);
    }

    #[Route('/{id}', name: 'abonnement_update', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $abonnement = $this->repository->find($id);
        if (!$abonnement) return new JsonResponse(['error' => 'Abonnement non trouvé'], 404);

        $data = json_decode($request->getContent(), true);
        // TODO: mapper les champs du JSON dans l'entité

        $this->em->flush();

        return new JsonResponse($abonnement);
    }


    #[Route('/{id}/toggle-auto-renew', name: 'abonnement_toggle_auto', methods: ['PATCH'])]
    public function toggleAutoRenewApi(int $id, Request $request): JsonResponse
    {
        $abonnement = $this->repository->find($id);
        if (!$abonnement) return new JsonResponse(['success' => false]);

        $data = json_decode($request->getContent(), true);
        $abonnement->setAutoRenew($data['autoRenew'] ?? false);

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/proches-expiration/{jours}', name: 'abonnement_proches_expiration', methods: ['GET'])]
    public function prochesExpiration(int $jours): JsonResponse
    {
        $dateLimite = new \DateTime();
        $dateLimite->modify("+$jours days");

        $abonnements = $this->repository->createQueryBuilder('a')
            ->andWhere('a.dateFin <= :dateLimite')
            ->setParameter('dateLimite', $dateLimite)
            ->getQuery()
            ->getResult();

        return new JsonResponse($abonnements);
    }

    #[Route('/total-points', name: 'abonnement_total_points', methods: ['GET'])]
    public function totalPoints(): JsonResponse
    {
        $total = $this->repository->createQueryBuilder('a')
            ->select('SUM(a.pointsAccumules)')
            ->getQuery()
            ->getSingleScalarResult();

        return new JsonResponse(['totalPoints' => $total]);
    }

    #[Route('/total-points/{userId}', name: 'abonnement_total_points_user', methods: ['GET'])]
    public function totalPointsByUser(int $userId): JsonResponse
    {
        $total = $this->repository->createQueryBuilder('a')
            ->select('SUM(a.pointsAccumules)')
            ->andWhere('a.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getSingleScalarResult();

        return new JsonResponse(['totalPoints' => $total]);
    }
}