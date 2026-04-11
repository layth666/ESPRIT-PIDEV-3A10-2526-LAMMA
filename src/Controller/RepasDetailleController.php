<?php
namespace App\Controller;
use App\Entity\RepasDetaille;use App\Form\RepasDetailleType;use App\Repository\RepasDetailleRepository;
use Doctrine\ORM\EntityManagerInterface;use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request,Response};use Symfony\Component\Routing\Annotation\Route;
#[Route('/repas-detaille')]
class RepasDetailleController extends AbstractController {
    #[Route('/',name:'app_repas_detaille_index')] public function index(RepasDetailleRepository $r):Response{return $this->render('repas_detaille/index.html.twig',['items'=>$r->findAll()]);}
    #[Route('/new',name:'app_repas_detaille_new')] public function new(Request $req,EntityManagerInterface $em):Response{$e=new RepasDetaille();$f=$this->createForm(RepasDetailleType::class,$e);$f->handleRequest($req);if($f->isSubmitted()&&$f->isValid()){$em->persist($e);$em->flush();$this->addFlash('success','Repas détaillé créé.');return $this->redirectToRoute('app_repas_detaille_index');}return $this->render('repas_detaille/new.html.twig',['form'=>$f->createView()]);}
    #[Route('/{id}',name:'app_repas_detaille_show',requirements:['id'=>'\d+'])] public function show(RepasDetaille $e):Response{return $this->render('repas_detaille/show.html.twig',['item'=>$e]);}
    #[Route('/{id}/edit',name:'app_repas_detaille_edit')] public function edit(Request $req,RepasDetaille $e,EntityManagerInterface $em):Response{$f=$this->createForm(RepasDetailleType::class,$e);$f->handleRequest($req);if($f->isSubmitted()&&$f->isValid()){$em->flush();$this->addFlash('success','Modifié.');return $this->redirectToRoute('app_repas_detaille_index');}return $this->render('repas_detaille/edit.html.twig',['form'=>$f->createView(),'item'=>$e]);}
    #[Route('/{id}/delete',name:'app_repas_detaille_delete',methods:['POST'])] public function delete(Request $req,RepasDetaille $e,EntityManagerInterface $em):Response{if($this->isCsrfTokenValid('delete'.$e->getId(),$req->request->get('_token'))){$em->remove($e);$em->flush();$this->addFlash('success','Supprimé.');}return $this->redirectToRoute('app_repas_detaille_index');}

    #[Route('/api/analyze-image', name: 'app_repas_detaille_analyze_image', methods: ['POST'])]
    public function analyzeImage(Request $request, \App\Service\GeminiMenuAnalyzer $gemini): Response
    {
        $file = $request->files->get('image');
        if (!$file) {
            return $this->json(['error' => 'Aucune image fournie'], 400);
        }
        
        try {
            $data = $gemini->extractMenuData($file);
            return $this->json($data);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }
}
