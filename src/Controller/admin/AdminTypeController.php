<?php

namespace App\Controller\admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminTypeController extends AbstractController
{
    /**
     * @Route("/admin/type", name="admin.type")
     */
    public function typeAdmin(TypeRepository $repo)
    {
        $types = $repo->findAll();
        return $this->render('admin_type/typeAdmin.html.twig',[
            'types'=>$types
        ]);
    }

    /**
     * @Route("/admin/type/create", name="admin.type.create")
     * @Route("/admin/type/{id}", name="admin.type.modif", methods ="GET|POST")
     */
    public function typeAdminMoCr(Type $type = null,Request $req, EntityManagerInterface $man)
    {
        if(!$type){
            $type = new Type();
        }

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){

            $man->persist($type);
            $man->flush();
            $this->addFlash('success','ok');
            
            return $this->redirectToRoute("admin.type"); // ne pas oublier le return

        }


        return $this->render('admin_type/typeAdminMoCr.html.twig',[
            'type'=>$type,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/type/{id}", name="admin.type.suppr" , methods="delete")
     */
    public function typeAdminSupp(Type $type ,Request $req)
    {
        $man = $this->getDoctrine()->getManager();
        if($this->isCsrfTokenValid("SUP".$type->getId(),$req->get('_token'))){

            $man->remove($type);
            $man->flush();
            $this->addFlash('success', 'supression ok');
            return $this->redirectToRoute("admin.type");
        }

    }

}
