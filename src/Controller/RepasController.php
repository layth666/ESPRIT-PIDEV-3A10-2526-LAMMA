<?php

namespace App\Controller;

use App\Entity\Repas;
use App\Repository\RepasRepository;
use App\Repository\RestaurantRepository;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/repas')]
#[IsGranted('ROLE_USER')]
class RepasController extends AbstractController
{
    private RepasRepository $repasRepository;
    private RestaurantRepository $restaurantRepository;
    private MenuRepository $menuRepository;
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em,
        RepasRepository $repasRepository,
        RestaurantRepository $restaurantRepository,
        MenuRepository $menuRepository
    ) {
        $this->em = $em;
        $this->repasRepository = $repasRepository;
        $this->restaurantRepository = $restaurantRepository;
        $this->menuRepository = $menuRepository;
    }

    #[Route('', name: 'app_repas_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('repas/index.html.twig', [
            'items' => $this->repasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_repas_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request): Response
    {
        $repas = new Repas();
        $form = $this->createForm(\App\Form\RepasType::class, $repas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($repas);
            $this->em->flush();
            return $this->redirectToRoute('app_repas_index');
        }

        return $this->render('repas/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_repas_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(int $id, Request $request): Response
    {
        $repas = $this->repasRepository->find($id);
        if (!$repas) throw $this->createNotFoundException();

        $form = $this->createForm(\App\Form\RepasType::class, $repas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('app_repas_index');
        }

        return $this->render('repas/edit.html.twig', [
            'form' => $form->createView(),
            'item' => $repas
        ]);
    }

    #[Route('/{id}/show', name: 'app_repas_show', methods: ['GET'])]
    public function showWeb(int $id): Response
    {
        $repas = $this->repasRepository->find($id);
        if (!$repas) throw $this->createNotFoundException();
        return $this->render('repas/show.html.twig', ['item' => $repas]);
    }

    #[Route('/api/{id}', name: 'repas_get_api', methods: ['GET'])]
    public function getApi(int $id): JsonResponse
    {
        $repas = $this->repasRepository->find($id);
        if (!$repas) {
            return new JsonResponse(['error' => 'Repas non trouvé'], 404);
        }
        return new JsonResponse($repas);
    }

    #[Route('', name: 'app_repas_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $repas = new Repas();
        $repas->setNom($data['nom'] ?? null);
        $repas->setDescription($data['description'] ?? null);
        $repas->setPrix($data['prix'] ?? null);
        $repas->setCategorie($data['categorie'] ?? null);
        $repas->setTypePlat($data['typePlat'] ?? null);
        $repas->setTempsPreparation($data['tempsPreparation'] ?? null);
        $repas->setDisponible($data['disponible'] ?? true);

        if (!empty($data['restaurantId'])) {
            $repas->setRestaurantId((int)$data['restaurantId']);
        }

        if (!empty($data['menuId'])) {
            $repas->setMenuId((int)$data['menuId']);
        }

        $this->em->persist($repas);
        $this->em->flush();

        return new JsonResponse($repas, 201);
    }

    #[Route('/{id}', name: 'app_repas_update', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $repas = $this->repasRepository->find($id);
        if (!$repas) {
            return new JsonResponse(['error' => 'Repas non trouvé'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $repas->setNom($data['nom'] ?? $repas->getNom());
        $repas->setDescription($data['description'] ?? $repas->getDescription());
        $repas->setPrix($data['prix'] ?? $repas->getPrix());
        $repas->setCategorie($data['categorie'] ?? $repas->getCategorie());
        $repas->setTypePlat($data['typePlat'] ?? $repas->getTypePlat());
        $repas->setTempsPreparation($data['tempsPreparation'] ?? $repas->getTempsPreparation());
        $repas->setDisponible($data['disponible'] ?? $repas->isDisponible());

        if (!empty($data['restaurantId'])) {
            $repas->setRestaurantId((int)$data['restaurantId']);
        }

        if (!empty($data['menuId'])) {
            $repas->setMenuId((int)$data['menuId']);
        }

        $this->em->flush();

        return new JsonResponse($repas);
    }

    #[Route('/{id}/delete/web', name: 'app_repas_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteWeb(int $id, Request $request): Response
    {
        $repas = $this->repasRepository->find($id);
        if ($repas && $this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $this->em->remove($repas);
            $this->em->flush();
            $this->addFlash('success', 'Repas supprimé');
        }
        return $this->redirectToRoute('app_repas_index');
    }

    #[Route('/api/{id}', name: 'repas_delete_api', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $repas = $this->repasRepository->find($id);
        if (!$repas) {
            return new JsonResponse(['success' => false]);
        }

        $this->em->remove($repas);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }
}