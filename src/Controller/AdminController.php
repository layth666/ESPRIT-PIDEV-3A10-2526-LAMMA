<?php

namespace App\Controller;

use App\Repository\SponsorRepository;
use App\Repository\EventSponsorRepository;
use App\Repository\SponsorFeedbackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/admin')]
final class AdminController extends AbstractController
{
    #[Route('', name: 'app_admin')]
    public function index(
        SponsorRepository $sponsorRepository,
        EventSponsorRepository $eventSponsorRepository,
        HttpClientInterface $httpClient
    ): Response {
        $totalSponsors     = count($sponsorRepository->findAll());
        $sponsorsActifs    = count($sponsorRepository->findBy(['statut' => true]));
        $totalAssociations = count($eventSponsorRepository->findAll());

        $allEventSponsors = $eventSponsorRepository->findAll();
        $montantTotal = 0;
        foreach ($allEventSponsors as $es) {
            $montantTotal += $es->getMontant();
        }

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
        arsort($montantParEvenement);

        $montantParNiveau = ['GOLD' => 0, 'SILVER' => 0, 'BRONZE' => 0, 'PARTENAIRE' => 0];
        foreach ($allEventSponsors as $es) {
            $niveau = $es->getNiveau();
            if (isset($montantParNiveau[$niveau])) {
                $montantParNiveau[$niveau] += $es->getMontant();
            }
        }

        $rates = [];
        try {
            $response = $httpClient->request('GET', 'https://open.er-api.com/v6/latest/TND', [
                'timeout' => 5,
            ]);

            if ($response->getStatusCode() === 200) {
                $data = $response->toArray(false);
                $rates = $data['rates'] ?? [];
            }
        } catch (\Throwable $e) {
            // fallback: keep rates empty
        }

        return $this->render('admin/base_admin.html.twig', [
            'totalSponsors'      => $totalSponsors,
            'sponsorsActifs'     => $sponsorsActifs,
            'totalAssociations'  => $totalAssociations,
            'montantTotal'       => $montantTotal,
            'montantParEvenement'=> $montantParEvenement,
            'montantParNiveau'   => $montantParNiveau,
            'rates'              => $rates,
            'baseCurrency'       => 'TND',
        ]);
    }

    #[Route('/sponsor-reports', name: 'admin_sponsor_reports')]
    public function sponsorReports(SponsorFeedbackRepository $feedbackRepository): Response
    {
        return $this->render('admin/sponsor_reports.html.twig', [
            'reports'   => $feedbackRepository->findAllReports(),
            'feedbacks' => $feedbackRepository->findAllFeedbacks(),
        ]);
    }

    #[Route('/sponsor-feedback', name: 'admin_sponsor_feedback')]
    public function sponsorFeedback(SponsorFeedbackRepository $repo): Response
    {
        $entries = $repo->createQueryBuilder('f')
            ->orderBy('f.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('admin/sponsor_feedback_admin.html.twig', [
            'entries' => $entries,
        ]);
    }
}
