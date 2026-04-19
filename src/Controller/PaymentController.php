<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Repository\EquipementsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    public function __construct(
        private EquipementsRepository $equipementRepository,
        private UserRepository $userRepository,
        private EntityManagerInterface $em
    ) {}

    #[Route('/payment/{id}', name: 'app_payment', requirements: ['id' => '\d+'])]
    public function index(string $id, SessionInterface $session): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

        if (!$currentUser) {
            $this->addFlash('error', 'Veuillez vous connecter pour procéder au paiement.');
            return $this->redirectToRoute('app_boutique_show', ['id' => $id]);
        }
        
        $delivery = $equipement->getDelivery();
        if ($delivery && $delivery->getAcheteur() !== $currentUser) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas l\'acheteur de cet équipement.');
        }

        return $this->render('payment/index.html.twig', [
            'stripe_public_key' => $_ENV['STRIPE_PUBLIC_KEY'] ?? '',
            'equipement' => $equipement,
        ]);
    }

    #[Route('/payment/{id}/process', name: 'app_payment_process', methods: ['POST'])]
    public function process(Request $request, string $id, SessionInterface $session): Response
    {
        $equipement = $this->equipementRepository->find($id);
        if (!$equipement) {
            throw $this->createNotFoundException();
        }

        $currentUserId = $session->get('current_user_id');
        $currentUser = $currentUserId ? $this->userRepository->find($currentUserId) : null;

        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'Non connecté']);
        }

        $token = $request->request->get('stripeToken');
        
        // --- LOGIQUE METIER TRANSACTION --- //
        $transaction = new Transaction();
        $transaction->setEquipement($equipement);
        $transaction->setBuyer($currentUser);
        $transaction->setSeller($equipement->getOwner());
        $transaction->setPrice($equipement->getPrix());
        $transaction->setStripeToken($token);
        
        $this->em->persist($transaction);

        // Mettre à jour le statut de l'équipement
        $equipement->setStatut('VENDU');

        // Mettre à jour la livraison si elle existe
        if ($equipement->getDelivery()) {
            $equipement->getDelivery()->setStatut('preparation');
        }

        $this->em->flush();

        $this->addFlash('success', 'Paiement effectué avec succès !');
        
        return $this->json(['success' => true]);
    }
}
