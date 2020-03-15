<?php

namespace App\Controller;

use App\Repository\AlimentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{


    /**
     * @Route("/aliments", name="aliments")
     */
    public function ListAliment(AlimentsRepository $repo)
    {
        $alims = $repo->findAll();

        return $this->render('aliment/aliments.html.twig',[
            'alims' => $alims
        ]);
    }

    /**
     * @Route("/", name="Acceuil")
     */
    public function index()
    {
        return $this->render('aliment/index.html.twig');
    }
}
