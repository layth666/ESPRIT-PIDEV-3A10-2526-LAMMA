<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ParticipationRepository;
use App\Repository\RestaurantRepository;
use App\Entity\Participation;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(
        ParticipationRepository $pr, 
        RestaurantRepository $rr, 
        \App\Repository\AbonnementRepository $ar, 
        \App\Repository\FavoriRepository $fr
    ): Response
    {
        // Calculate platform stats
        $confirmedParticipations = $pr->findByStatut(Participation::STATUT_CONFIRME);
        
        $totalParticipants = 0;
        $totalRevenue = 0;
        foreach ($confirmedParticipations as $p) {
            $totalParticipants += $p->getTotalParticipants();
            $totalRevenue += (float) $p->getMontantCalcule();
        }
        
        $totalRestaurants = count($rr->findAll());

        // Advanced Stats for Google Charts
        $revenueStats = $ar->getRevenueStats();
        $popularityStats = $fr->getPopularityStats();
        
        // Participation timeline (grouped by month)
        $timelineRaw = $pr->createQueryBuilder('p')
            ->select("SUBSTRING(p.dateInscription, 1, 7) as month, COUNT(p.id) as total")
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('admin/dashboard.html.twig', [
            'totalParticipants' => $totalParticipants,
            'totalRestaurants' => $totalRestaurants,
            'totalRevenue' => $totalRevenue,
            'revenueStats' => $revenueStats,
            'popularityStats' => $popularityStats,
            'participationTimeline' => $timelineRaw
        ]);
    }
}
