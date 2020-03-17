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
     * route creation
     * @Route("/admin/aliment/creation", name="admin.aliment.creation")
     * route modif
     * @Route("/admin/aliment/{id}", name="admin.aliment.modif",methods="GET|POST")
     */
    public function showOne(Aliments $alim = null,Request $req,EntityManagerInterface $man)
    {


        if(!$alim){      // si alim est null creation d'un new aliment
            $alim = new Aliments();
        }

        $form = $this->createForm(AlimentType::class,$alim);//createform recoit le formulaire et en objet l'aliment a modifier

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $alim->getId() !== null;
            $man->persist($alim);
            $man->flush();
            $this->addFlash('success', ($modif) ? "modification bien effectuer" : "Ajouter avec success" );
            return $this->redirectToRoute('admin_aliment');
            
        }
        return $this->render('admin_aliment/adminAlimentMofiCreat.html.twig',[
            'alim'=>$alim,
            "form"=>$form->createView(),
            "isModif"=> $alim->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/aliment/{id}", name="admin.aliment.suppr", methods="delete")
     */
    public function SupprOne(Aliments $alim,Request $req)
    
    {
        $man = $this->getDoctrine()->getManager();
        if($this->isCsrfTokenValid("SUP".$alim->getId(),$req->get('_token'))){
        $man->remove($alim);
            $man->flush();
            $this->addFlash('success', "Suppression bien effectuer");
            return $this->redirectToRoute('admin_aliment');

        }
    }
            
        

}
