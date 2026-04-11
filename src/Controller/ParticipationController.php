<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/participations')]
#[IsGranted('ROLE_USER')]
class ParticipationController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private ParticipationRepository $repository
    ) {}

    // ===== INDEX =====
    #[Route('/', name: 'app_participation_index', methods: ['GET'])]
    public function index(): Response
    {
        $qb = $this->repository->createQueryBuilder('p');

        if (!$this->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            $qb->andWhere('p.userId = :user')
               ->setParameter('user', method_exists($user, 'getId') ? $user->getId() : 0);
        }

        return $this->render('participation/index.html.twig', [
            'items' => $qb->getQuery()->getResult(),
        ]);
    }

    // ===== NEW =====
    #[Route('/new', name: 'app_participation_new', methods: ['GET', 'POST'])]
    public function newWeb(Request $request): Response
    {
        $participation = new Participation();

        $form = $this->createForm(\App\Form\ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $evenement = $form->get('evenement')->getData();
            if ($evenement) {
                $participation->setEvenementId($evenement->getId());
            }

            $user = $this->getUser();
            $participation->setUserId(method_exists($user, 'getId') ? $user->getId() : 0);

            // valeurs par défaut
            $participation->setStatut(Participation::STATUT_EN_ATTENTE);

            // 🔥 Calcul automatique
            $participation->calculerTotalParticipants();

            // 🔥 Gestion abonnement
            $wantAbonnement = $request->request->get('want_abonnement');

            if ($wantAbonnement === '1') {
                $participation->setTypeAbonnementChoisi('OUI');
            } else {
                $participation->setTypeAbonnementChoisi('NON');
            }

            // 🔥 Calcul montant simple (optionnel)
            $montant = (
                $participation->getNbAdultes() * 25 +
                $participation->getNbEnfants() * 12.5 +
                $participation->getHebergementNuits() * 40
            );

            if ($participation->getMealOption() && $participation->getMealOption() !== 'SANS_REPAS') {
                $montant += ($participation->getNbAdultes() + $participation->getNbEnfants()) * 15;
            }

            $participation->setMontantCalcule((string)$montant);

            $this->em->persist($participation);
            $this->em->flush();

            // 🔥 Création du Ticket / Badge / Pass
            $generateType = $form->get('generateType')->getData();
            if ($generateType) {
                $ticket = new \App\Entity\Ticket();
                $ticket->setParticipationId($participation->getId());
                $ticket->setUserId($participation->getUserId());
                $ticket->setType($generateType);
                $ticket->setQrCode($generateType . '-' . uniqid());
                $this->em->persist($ticket);
                $this->em->flush();
            }

            // If user wants abonnement, redirect to abonnement creation page
            if ($wantAbonnement === '1') {
                $this->addFlash('success', '✅ Inscription réussie ! Créez maintenant votre abonnement.');
                return $this->redirectToRoute('app_abonnement_new');
            }

            $this->addFlash('success', '✅ Inscription réussie ! Le ticket a été généré.');
            return $this->redirectToRoute('app_participation_index');
        }

        return $this->render('participation/new.html.twig', [
            'participation' => $participation,
            'form' => $form->createView(),
        ]);
    }

    // ===== SHOW =====
    #[Route('/{id}', name: 'app_participation_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $participation = $this->repository->find($id);

        if (!$participation) {
            throw $this->createNotFoundException();
        }

        return $this->render('participation/show.html.twig', [
            'item' => $participation,
        ]);
    }

    // ===== EDIT =====
    #[Route('/{id}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', '⛔ Les administrateurs ne peuvent pas modifier les inscriptions directement.');
            return $this->redirectToRoute('app_participation_show', ['id' => $id]);
        }
        $participation = $this->repository->find($id);

        if (!$participation) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(\App\Form\ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $evenement = $form->get('evenement')->getData();
            if ($evenement) {
                $participation->setEvenementId($evenement->getId());
            }

            $participation->calculerTotalParticipants();

            $this->em->flush();

            $this->addFlash('success', '✏️ Modification réussie');

            return $this->redirectToRoute('app_participation_index');
        }

        return $this->render('participation/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ===== CONFIRMER =====
    #[Route('/{id}/confirmer', name: 'app_participation_confirmer', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function confirmer(int $id): Response
    {
        $participation = $this->repository->find($id);

        if ($participation) {
            $participation->confirmer(); // Uses internal business logic method
            $this->em->flush();
            $this->addFlash('success', '✅ Participation confirmée avec succès.');
        }

        return $this->redirectToRoute('app_participation_show', ['id' => $id]);
    }

    // ===== ANNULER =====
    #[Route('/{id}/annuler', name: 'app_participation_annuler', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function annuler(int $id): Response
    {
        $participation = $this->repository->find($id);

        if ($participation) {
            $participation->annuler(); // Uses internal business logic method
            $this->em->flush();
            $this->addFlash('success', '❌ Participation annulée.');
        }

        return $this->redirectToRoute('app_participation_show', ['id' => $id]);
    }

    // ===== DELETE =====
    #[Route('/{id}/delete', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(int $id, Request $request): Response
    {
        $item = $this->repository->find($id);

        if (!$item) {
            throw $this->createNotFoundException();
        }

        // Ownership check
        if (!$this->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            $userId = method_exists($user, 'getId') ? $user->getId() : 0;
            if ($item->getUserId() !== $userId) {
                throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer cette participation.');
            }
        }

        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $this->em->remove($item);
            $this->em->flush();
            $this->addFlash('success', 'Participation supprimée');
        }

        return $this->redirectToRoute('app_participation_index');
    }
}