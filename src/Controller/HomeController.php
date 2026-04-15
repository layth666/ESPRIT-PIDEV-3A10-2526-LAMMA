<?php
// src/Controller/HomeController.php
// Handles the root URL "/" and redirects appropriately.
// This replaces the default Symfony welcome page.

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Admin → dashboard
        if ($this->getUser() && $this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_users_index');
        }

        // Everyone else (not logged in, or regular USER) → login page
        return $this->redirectToRoute('app_login');
    }
}