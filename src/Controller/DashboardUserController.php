<?php

namespace App\Controller;

use App\Repository\FavoriRepository;
use App\Repository\ParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class DashboardUserController extends AbstractController
{
    private FavoriRepository $favoriRepo;
    private ParticipationRepository $participationRepo;

    public function __construct(FavoriRepository $favoriRepo, ParticipationRepository $participationRepo)
    {
        $this->favoriRepo = $favoriRepo;
        $this->participationRepo = $participationRepo;
    }

    #[Route('/dashboard/user', name: 'app_user_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_home');
        }

        $userId = $user->getId();
        $favoris = $this->favoriRepo->findByUser($userId);
        
        $restaurantsFavoris = [];
        $repasFavoris = [];

        foreach ($favoris as $f) {
            if ($f->getRestaurant()) {
                $restaurantsFavoris[] = $f->getRestaurant();
            }
            if ($f->getRepasDetaille()) {
                $repasFavoris[] = $f->getRepasDetaille();
            }
        }

        // Fetch recent participations for the user
        $participations = $this->participationRepo->findBy(['userId' => $userId], ['dateInscription' => 'DESC'], 5);

        return $this->render('dashboard/user.html.twig', [
            'user' => $user,
            'restaurantsFavoris' => $restaurantsFavoris,
            'repasFavoris' => $repasFavoris,
            'participations' => $participations,
        ]);
    }
}
