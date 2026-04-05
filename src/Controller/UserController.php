<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    #[Route('/', name: 'app_user_index')]
    public function index(SessionInterface $session): Response
    {
        if (!$this->isAdmin($session)) {
            $this->addFlash('error', 'Accès réservé à l’administrateur.');
            return $this->redirectToRoute('app_boutique');
        }

        $users = $this->userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/new', name: 'app_user_new')]
    public function new(Request $request, SessionInterface $session): Response
    {
        if (!$this->isAdmin($session)) {
            $this->addFlash('error', 'Accès réservé à l’administrateur.');
            return $this->redirectToRoute('app_boutique');
        }

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('success', 'Utilisateur ajouté !');

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit')]
    public function edit(Request $request, User $user, SessionInterface $session): Response
    {
        if (!$this->isAdmin($session)) {
            $this->addFlash('error', 'Accès réservé à l’administrateur.');
            return $this->redirectToRoute('app_boutique');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getPassword()) {
                $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            }
            $this->em->flush();

            $this->addFlash('success', 'Utilisateur modifié !');

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, SessionInterface $session): Response
    {
        if (!$this->isAdmin($session)) {
            $this->addFlash('error', 'Accès réservé à l’administrateur.');
            return $this->redirectToRoute('app_boutique');
        }

        $token = $request->request->getString('_token');
        if (!$this->isCsrfTokenValid('delete_user_' . $user->getId(), $token)) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $this->em->remove($user);
        $this->em->flush();
        $this->addFlash('success', 'Utilisateur supprimé.');

        return $this->redirectToRoute('app_user_index');
    }

    private function isAdmin(SessionInterface $session): bool
    {
        return $session->get('current_user_is_admin', false) === true;
    }
}