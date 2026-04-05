<?php
namespace App\Controller;
use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index')]
    public function index(EvenementRepository $r): Response { return $this->render('evenement/index.html.twig', ['items' => $r->findAll()]); }

    #[Route('/new', name: 'app_evenement_new')]
    public function new(Request $req, EntityManagerInterface $em): Response {
        $e = new Evenement(); $f = $this->createForm(EvenementType::class, $e); $f->handleRequest($req);
        if ($f->isSubmitted() && $f->isValid()) { $em->persist($e); $em->flush(); $this->addFlash('success','Événement créé.'); return $this->redirectToRoute('app_evenement_index'); }
        return $this->render('evenement/new.html.twig', ['form' => $f->createView()]);
    }

    #[Route('/{id}', name: 'app_evenement_show', requirements: ['id'=>'\d+'])]
    public function show(Evenement $e): Response { return $this->render('evenement/show.html.twig', ['item' => $e]); }

    #[Route('/{id}/edit', name: 'app_evenement_edit')]
    public function edit(Request $req, Evenement $e, EntityManagerInterface $em): Response {
        $f = $this->createForm(EvenementType::class, $e); $f->handleRequest($req);
        if ($f->isSubmitted() && $f->isValid()) { $em->flush(); $this->addFlash('success','Événement modifié.'); return $this->redirectToRoute('app_evenement_index'); }
        return $this->render('evenement/edit.html.twig', ['form' => $f->createView(), 'item' => $e]);
    }

    #[Route('/{id}/delete', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $req, Evenement $e, EntityManagerInterface $em): Response {
        if ($this->isCsrfTokenValid('delete'.$e->getId(), $req->request->get('_token'))) { $em->remove($e); $em->flush(); $this->addFlash('success','Événement supprimé.'); }
        return $this->redirectToRoute('app_evenement_index');
    }
}
