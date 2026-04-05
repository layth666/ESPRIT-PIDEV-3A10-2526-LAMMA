<?php

namespace App\Controller;

use App\Repository\SponsorRepository;
use App\Repository\EventSponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
final class AdminController extends AbstractController
{
    #[Route('', name: 'app_admin')]
    public function index(
        SponsorRepository $sponsorRepository,
        EventSponsorRepository $eventSponsorRepository
    ): Response {
        // Stats générales
        $totalSponsors = count($sponsorRepository->findAll());
        $sponsorsActifs = count($sponsorRepository->findBy(['statut' => true]));
        $totalAssociations = count($eventSponsorRepository->findAll());

        // Montant total collecté
        $allEventSponsors = $eventSponsorRepository->findAll();
        $montantTotal = 0;
        foreach ($allEventSponsors as $es) {
            $montantTotal += $es->getMontant();
        }

        // Montant par événement (pour le bar chart)
        $montantParEvenement = [];
        foreach ($allEventSponsors as $es) {
            try {
                $titre = $es->getEvent()->getTitre();
                if (!isset($montantParEvenement[$titre])) {
                    $montantParEvenement[$titre] = 0;
                }
                $montantParEvenement[$titre] += $es->getMontant();
            } catch (\Exception $e) {
                continue;
            }
        }

        // Trier par montant décroissant
        arsort($montantParEvenement);

        // Montant par niveau (pour pie chart)
        $montantParNiveau = ['GOLD' => 0, 'SILVER' => 0, 'BRONZE' => 0, 'PARTENAIRE' => 0];
        foreach ($allEventSponsors as $es) {
            $niveau = $es->getNiveau();
            if (isset($montantParNiveau[$niveau])) {
                $montantParNiveau[$niveau] += $es->getMontant();
            }
        }

        return $this->render('admin/base_admin.html.twig', [
            'totalSponsors' => $totalSponsors,
            'sponsorsActifs' => $sponsorsActifs,
            'totalAssociations' => $totalAssociations,
            'montantTotal' => $montantTotal,
            'montantParEvenement' => $montantParEvenement,
            'montantParNiveau' => $montantParNiveau,
        ]);
    }
}
