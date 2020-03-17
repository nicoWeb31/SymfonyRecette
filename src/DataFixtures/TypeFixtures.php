<?php

namespace App\DataFixtures;

use App\Entity\Aliments;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $t1 = new Type(); 
            $t1->setLibelle('Fruits')
            ->setImgage("fruits.jpg");

            $manager->persist($t1);

            $t2 = new Type(); 
            $t2->setLibelle('Legumes')
            ->setImgage("legumes.jpg");

            $manager->persist($t2);


            $alimRep = $manager->getRepository(Aliments::class);
            $a1 = $alimRep->findOneBy(["name" => "Pomme"]);
            $a1->setType($t1);
            $manager->persist($a1);

            $a2 = $alimRep->findOneBy(["name" => "Tomate"]);
            $a2->setType($t2);
            $manager->persist($a2);

            $a3 = $alimRep->findOneBy(["name" => "Patate"]);
            $a3->setType($t2);
            $manager->persist($a3);

            $a4 = $alimRep->findOneBy(["name" => "carotte"]);
            $a4->setType($t2);
            $manager->persist($a4);

        $manager->flush();
    }
}
