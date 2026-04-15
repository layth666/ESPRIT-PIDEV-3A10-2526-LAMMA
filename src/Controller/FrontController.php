<?php

namespace App\Controller;

use App\Entity\SponsorFeedback;
use App\Repository\SponsorRepository;
use App\Repository\SponsorFeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'front_home')]
    public function index(
        SponsorRepository $sponsorRepository,
        SponsorFeedbackRepository $feedbackRepository
    ): Response {
        return $this->render('front/index.html.twig', [
            'sponsors'  => $sponsorRepository->findAll(),
            'feedbacks' => $feedbackRepository->findAllFeedbacks(),
        ]);
    }

    // Step 1: Check if nom + email match a sponsor
    #[Route('/sponsor/check', name: 'front_sponsor_check', methods: ['POST'])]
    public function checkSponsor(Request $request, SponsorRepository $sponsorRepository): JsonResponse
    {
        $nom   = trim($request->request->get('nom', ''));
        $email = trim($request->request->get('email', ''));

        $sponsor = $sponsorRepository->findOneBy([
            'nom'   => $nom,
            'email' => $email,
        ]);

        if ($sponsor) {
            return new JsonResponse(['success' => true, 'sponsorId' => $sponsor->getId()]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Aucun sponsor trouvé avec ces informations.']);
    }

    // Step 2: Submit feedback or report
    #[Route('/sponsor/feedback', name: 'front_sponsor_feedback', methods: ['POST'])]
    public function submitFeedback(
        Request $request,
        SponsorRepository $sponsorRepository,
        EntityManagerInterface $em
    ): JsonResponse {
        $sponsorId = $request->request->get('sponsorId');
        $type      = $request->request->get('type'); // 'feedback' or 'report'
        $contenu   = trim($request->request->get('contenu', ''));
        $nom       = trim($request->request->get('nom', ''));
        $email     = trim($request->request->get('email', ''));

        if (!in_array($type, ['feedback', 'report']) || empty($contenu)) {
            return new JsonResponse(['success' => false, 'message' => 'Données invalides.']);
        }

        $sponsor = $sponsorRepository->find($sponsorId);
        if (!$sponsor) {
            return new JsonResponse(['success' => false, 'message' => 'Sponsor introuvable.']);
        }

        $feedback = new SponsorFeedback();
        $feedback->setType($type);
        $feedback->setNom($nom);
        $feedback->setEmail($email);
        $feedback->setContenu($contenu);
        $feedback->setSponsor($sponsor);

        $em->persist($feedback);
        $em->flush();

        $message = $type === 'feedback'
            ? 'Merci pour votre feedback !'
            : 'Votre signalement a été envoyé.';

        return new JsonResponse(['success' => true, 'message' => $message, 'type' => $type]);
    }

    #[Route('/about', name: 'front_about')]
    public function about(): Response
    {
        return $this->render('front/about.html.twig');
    }

    #[Route('/performer', name: 'front_performer')]
    public function performer(): Response
    {
        return $this->render('front/performer.html.twig');
    }

    #[Route('/program', name: 'front_program')]
    public function program(): Response
    {
        return $this->render('front/program.html.twig');
    }

    #[Route('/venue', name: 'front_venue')]
    public function venue(): Response
    {
        return $this->render('front/venue.html.twig');
    }

    #[Route('/blog', name: 'front_blog')]
    public function blog(): Response
    {
        return $this->render('front/blog.html.twig');
    }

    #[Route('/blog/single', name: 'front_single_blog')]
    public function singleBlog(): Response
    {
        return $this->render('front/single-blog.html.twig');
    }

    #[Route('/contact', name: 'front_contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig');
    }
}
