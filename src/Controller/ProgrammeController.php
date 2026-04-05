<?php
namespace App\Controller;

use App\Entity\Programme;
use App\Entity\Evenement;
use App\Form\ProgrammeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/programme')]
class ProgrammeController extends AbstractController
{
    #[Route('/new', name: 'app_programme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->getSession()->get('role') !== 'admin') {
            throw $this->createAccessDeniedException('AccÃ¨s refusÃ© - RÃ©servÃ© aux administrateurs.');
        }

        $eventId = $request->query->get('event_id');
        $programme = new Programme();

        if ($eventId) {
            $event = $entityManager->getRepository(Evenement::class)->find($eventId);
            if ($event) {
                $programme->setEvent_id($event);
            }
        }

        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($programme);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_show', ['id' => $programme->getEvent_id()?->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programme/new.html.twig', [
            'programme' => $programme,
            'form' => $form->createView(),
        ]);
    }
}

