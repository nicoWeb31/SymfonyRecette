<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $req, EntityManagerInterface $man, UserPasswordEncoderInterface $encoder)
    {
        $user= new User();
        $form = $this->createForm(RegisterType::class,$user);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $passCry = $encoder->encodePassword($user,$user->getPass());
            $user->setPass($passCry);
            $man->persist($user);
            $man->flush();

            return $this->redirectToRoute('Acceuil');
        }

        return $this->render('admin_secu/register.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
