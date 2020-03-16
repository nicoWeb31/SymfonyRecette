<?php

namespace App\Controller\admin;

use App\Entity\Aliments;
use App\Form\AlimentType;
use App\Repository\AlimentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliment", name="admin_aliment")
     */
    public function index(AlimentsRepository $repo)
    {
        $aliments = $repo->findAll();
        return $this->render('admin_aliment/adminAliment.html.twig',[
            'aliments'=>$aliments
        ]);
    }

    /**
     * @Route("/admin/aliment/{id}", name="admin.aliment.one")
     */
    public function showOne(Aliments $alim,Request $req,EntityManagerInterface $man)
    {
        $form = $this->createForm(AlimentType::class,$alim);//createform recoit le formulaire et en objet l'aliment a modifier

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $man->persist($alim);
            $man->flush();
            return $this->redirectToRoute('admin_aliment');
            
        }
        return $this->render('admin_aliment/adminAlimentOne.html.twig',[
            'alim'=>$alim,
            "form"=>$form->createView()
        ]);
    }
}
