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
            'alims' => $alims,
            'isCalorie' => false,
            'isGlucide'=>false

        ]);
    }

    /**
     * @Route("/", name="Acceuil")
     */
    public function index()
    {
        return $this->render('aliment/index.html.twig');
    }


    /**
     * @Route("/aliments/calorie/{calorie}", name="alimentsByCalorie")
     */
    public function ListAlByProperties(AlimentsRepository $repo, $calorie)
    {
        $alims = $repo->findAliByProperties('calorie','<',$calorie);

        return $this->render('aliment/aliments.html.twig',[
            'alims' => $alims,
            'isCalorie'=>true,
            'isGlucide'=>false


        ]);
    }

    /**
     * @Route("/aliments/glucides/{glucides}", name="alimentsByGlucide")
     */
    public function alimentMoinsGluicide(AlimentsRepository $repo, $glucides)
    {
        $alims = $repo->findAliByProperties('glucides','<',$glucides);

        return $this->render('aliment/aliments.html.twig',[
            'alims' => $alims,
            'isCalorie'=>false,
            'isGlucide'=>true

        ]);
    }
}
