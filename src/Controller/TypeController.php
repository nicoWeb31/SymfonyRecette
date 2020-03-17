<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Doctrine\DBAL\Types\TypeRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     */
    public function TypeAll(TypeRepository $rep)
    {
        $types = $rep->findAll();
        return $this->render('type/type.html.twig',[
            'types'=>$types
        ]);
    }
}
