<?php

namespace App\DataFixtures;

use App\Entity\Aliments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        $a1 = new Aliments();

        $a1->setName('Carrotte')
            ->setCalorie(36)
            ->setPrice(1.80)
            ->setImg("aliments/carotte.png")
            ->setProteine(0.77)
            ->setGlucides(0.23)
            ->setLipides(0.3);

        $manager->persist($a1);


        $a2 = new Aliments();

        $a2->setName('Pomme')
            ->setCalorie(36)
            ->setPrice(1.80)
            ->setImg("aliments/pomme.png")
            ->setProteine(0.75)
            ->setGlucides(0.23)
            ->setLipides(0.6);

        $manager->persist($a2);


        $a3 = new Aliments();

        $a3->setName('Tomate')
            ->setCalorie(45)
            ->setPrice(3.80)
            ->setImg("aliments/tomate.png")
            ->setProteine(0.75)
            ->setGlucides(0.23)
            ->setLipides(0.3);

        $manager->persist($a3);

        $a4 = new Aliments();

        $a4->setName('Patate')
            ->setCalorie(45)
            ->setPrice(4.80)
            ->setImg("aliments/patate.png")
            ->setProteine(0.77)
            ->setGlucides(0.23)
            ->setLipides(0.9);

        $manager->persist($a4);




        $manager->flush();
    }
}
