<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Pain;
use App\Entity\Oignon;
use App\Entity\Sauce;
use App\Entity\Image;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BurgerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d’un pain
        $pain = new Pain();
        $pain->setName('Pain brioché');
        $manager->persist($pain);

        // Création d’un oignon
        $oignon = new Oignon();
        $oignon->setName('Oignon rouge');
        $manager->persist($oignon);

        // Création d’une sauce
        $sauce = new Sauce();
        $sauce->setName('Sauce BBQ');
        $manager->persist($sauce);

        // Création d’une image
        $image = new Image();
        $image->setName('burger1.jpg');
        $manager->persist($image);

        // Création d’un commentaire
        $commentaire = new Commentaire();
        $commentaire->setName('Délicieux burger, à recommander !');
        // La liaison au burger sera ajoutée après la création du burger

        // Création du burger
        $burger = new Burger();
        $burger->setName('Burger BBQ Deluxe');
        $burger->setPrice('12.99');
        $burger->setPain($pain);
        $burger->addOignon($oignon);
        $burger->addSauce($sauce);
        $burger->setImage($image);

        $manager->persist($burger);

        // Liaison du commentaire au burger
        $commentaire->setBurger($burger);
        $manager->persist($commentaire);

        // Sauvegarde en base
        $manager->flush();
    }
}
