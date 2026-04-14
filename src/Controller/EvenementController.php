<?php
namespace App\Controller;

use App\Entity\Equipment;
use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/evenement')]
final class EvenementController extends AbstractController
{
    #[Route('/switch-role/{role}', name: 'app_switch_role', methods: ['GET'])]
    public function switchRole(string $role, Request $request): Response
    {
        $request->getSession()->set('role', $role);
        return $this->redirectToRoute('app_evenement_index');
    }

    #[Route(name: 'app_evenement_index', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $search = $request->query->get('search');
        $sort = $request->query->get('sort');

        $qb = $entityManager->getRepository(Evenement::class)->createQueryBuilder('e');

        if ($search) {
            $qb->andWhere('e.titre LIKE :search OR e.lieu LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }

        if ($sort) {
            $sortOrder = $request->query->get('order', 'ASC');
            $validSorts = ['titre', 'date_debut', 'date_fin', 'nb_vues', 'lieu'];
            if (in_array($sort, $validSorts)) {
                $qb->orderBy('e.' . $sort, $sortOrder);
            }
        }

        $evenements = $qb->getQuery()->getResult();
        $role = $request->getSession()->get('role', 'user');

        if ($role === 'admin') {
            return $this->render('admin_evenement/index.html.twig', [
                'evenements' => $evenements,
                'role' => $role,
            ]);
        }

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
            'role' => $role,
        ]);
    }

    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->getSession()->get('role') !== 'admin') {
            throw $this->createAccessDeniedException('AccÃ¨s refusÃ© - RÃ©servÃ© aux administrateurs.');
        }

        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evenement);
            
            $equipmentsString = $form->get('recommended_equipments')->getData();
            if ($equipmentsString) {
                $equipmentsList = explode(',', $equipmentsString);
                foreach ($equipmentsList as $equipmentName) {
                    $equipmentName = trim($equipmentName);
                    if ($equipmentName !== '') {
                        $equipment = new Equipment();
                        $equipment->setLibelle($equipmentName);
                        $equipment->setEvent_id($evenement);
                        $entityManager->persist($equipment);
                    }
                }
            }
            
            $entityManager->flush();

            $this->addFlash('ask_add_prog', $evenement->getId_event());

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement, Request $request): Response
    {
        $role = $request->getSession()->get('role', 'user');

        if ($role === 'admin') {
            return $this->render('admin_evenement/show.html.twig', [
                'evenement' => $evenement,
                'role' => $role,
            ]);
        }

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'role' => $role,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($request->getSession()->get('role') !== 'admin') {
            throw $this->createAccessDeniedException('AccÃ¨s refusÃ© - RÃ©servÃ© aux administrateurs.');
        }

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($request->getSession()->get('role') !== 'admin') {
            throw $this->createAccessDeniedException('AccÃ¨s refusÃ© - RÃ©servÃ© aux administrateurs.');
        }

        if ($this->isCsrfTokenValid('delete'.$evenement->getId_event(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}

