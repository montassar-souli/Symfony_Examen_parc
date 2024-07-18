<?php

namespace App\Controller;

use App\Entity\Arbre;
use App\Entity\Parc;
use App\Form\AddArbreType;
use App\Form\AddParcType;
use App\Form\UpdateArbreType;
use App\Form\UpdateParcType;
use App\Repository\ArbreRepository;
use App\Repository\ParcRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExamenController extends AbstractController
{
    #[Route('/examen', name: 'app_examen')]
    public function index(): Response
    {
        return $this->render('examen/index.html.twig', [
            'controller_name' => 'ExamenController',
        ]);
    }

    #[Route('/arbreAdd', name: 'arbreAdd')]
    public function arbreAdd(ParcRepository $repo,ManagerRegistry $mr,Request $req): Response
    {
        $arbre = new Arbre();
        $form = $this->createForm(AddArbreType::class,$arbre);
        $form->handleRequest($req);

        if($form->isSubmitted()){
            $arbre->setDateImplantation(new \DateTime());
            $arbre->setParc($repo->find(10));

            $em = $mr->getManager();
            $em->persist($arbre);
            $em->flush();
            return $this->redirectToRoute('arbreList');
        }
        return $this->renderForm('examen/arbreAdd.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/arbreList', name: 'arbreList')]
    public function arbreList(Request $request, ArbreRepository $repo): Response
    {
        $adresse = $request->query->get('adresse');
        if ($adresse) {
            $arbres = $repo->findByParcAdresse($adresse);
        } else {
            $arbres = $repo->findAll();
        }

        return $this->render('examen/arbreList.html.twig', [
            'arbres' => $arbres,
        ]);
    }

    #[Route('/arbreRemove/{id}', name: 'arbreRemove')]
    public function arbreRemove(ManagerRegistry $mr,Arbre $arbre): Response
    {
        $em = $mr->getManager();
        $em->remove($arbre);
        $em->flush();
        return $this->redirectToRoute('arbreList');
    }

    #[Route('/arbreUpdate/{id}', name: 'arbreUpdate')]
    public function arbreUpdate(ManagerRegistry $mr,Request $req,Arbre $arbre): Response
    {
        $form = $this->createForm(UpdateArbreType::class, $arbre);

        if ($form->isSubmitted()) {
            $em = $mr->getManager();
            $em->flush();
            return $this->redirectToRoute('arbreList');
        }
//        dd($formId);
        return $this->renderForm('examen/arbreUpdate.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/parcList', name: 'parcList')]
    public function parcList(ParcRepository $repo): Response
    {
        return $this->render('examen/parcList.html.twig',[
            'parc'=> $repo->findAll()
        ]);
    }

    #[Route('/parcAdd', name: 'parcAdd')]
    public function parcAdd(Request $req,ManagerRegistry $mr): Response
    {
        $parc = new Parc();
        $form = $this->createForm(AddParcType::class,$parc);
        $form->handleRequest($req);
        if ($form->isSubmitted()){
            $em = $mr->getManager();
            $em->persist($parc);
            $em->flush();
            return $this->redirectToRoute('parcList');
        }
        return $this->renderForm('examen/parcAdd.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/parcUpdate/{id}', name: 'parcUpdate')]
    public function parcUpdate(Request $req,ManagerRegistry $mr,Parc $parc): Response
    {
        $form = $this->createForm(UpdateParcType::class,$parc);
        $form->handleRequest($req);
        if ($form->isSubmitted()){
            $em = $mr->getManager();
            $em->flush();
            return $this->redirectToRoute('parcList');
        }
        return $this->renderForm('examen/parcUpdate.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/parcRemove/{id}', name: 'parcRemove')]
    public function parcRemove(ManagerRegistry $mr,Parc $parc): Response
    {
            $em = $mr->getManager();
            $em->remove($parc);
            $em->flush();
            return $this->redirectToRoute('parcList');
    }


}
