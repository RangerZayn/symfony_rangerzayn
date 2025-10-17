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
        // Pains
        $pain1 = new Pain();
        $pain1->setName('Pain brioché');
        $manager->persist($pain1);
        $this->addReference('pain_1', $pain1);

        $pain2 = new Pain();
        $pain2->setName('Pain aux sésames');
        $manager->persist($pain2);
        $this->addReference('pain_2', $pain2);

        $pain3 = new Pain();
        $pain3->setName('Pain complet');
        $manager->persist($pain3);
        $this->addReference('pain_3', $pain3);

        // Oignons
        $oignon1 = new Oignon();
        $oignon1->setName('Oignon rouge');
        $manager->persist($oignon1);
        $this->addReference('oignon_1', $oignon1);

        $oignon2 = new Oignon();
        $oignon2->setName('Oignon caramélisé');
        $manager->persist($oignon2);
        $this->addReference('oignon_2', $oignon2);

        $oignon3 = new Oignon();
        $oignon3->setName('Oignon frit');
        $manager->persist($oignon3);
        $this->addReference('oignon_3', $oignon3);

        // Sauces
        $sauce1 = new Sauce();
        $sauce1->setName('Sauce BBQ');
        $manager->persist($sauce1);
        $this->addReference('sauce_1', $sauce1);

        $sauce2 = new Sauce();
        $sauce2->setName('Sauce Ketchup');
        $manager->persist($sauce2);
        $this->addReference('sauce_2', $sauce2);

        $sauce3 = new Sauce();
        $sauce3->setName('Sauce Mayonnaise');
        $manager->persist($sauce3);
        $this->addReference('sauce_3', $sauce3);

        // Images
        $image1 = new Image();
        $image1->setName('burger1.jpg');
        $manager->persist($image1);
        $this->addReference('image_1', $image1);

        $image2 = new Image();
        $image2->setName('burger2.jpg');
        $manager->persist($image2);
        $this->addReference('image_2', $image2);

        $image3 = new Image();
        $image3->setName('burger3.jpg');
        $manager->persist($image3);
        $this->addReference('image_3', $image3);
        
        $image4 = new Image();
        $image4->setName('burger4.jpg');
        $manager->persist($image4);
        $this->addReference('image_4', $image4);

        $image5 = new Image();
        $image5->setName('burger5.jpg');
        $manager->persist($image5);
        $this->addReference('image_5', $image5);

        $image6 = new Image();
        $image6->setName('burger6.jpg');
        $manager->persist($image6);
        $this->addReference('image_6', $image6);


        $burgersData = [
            [
                'name' => 'Burger BBQ Deluxe',
                'price' => 12.99,
                'pain' => 'pain_1',
                'oignons' => ['oignon_1', 'oignon_2'],
                'sauces' => ['sauce_1'],
                'image' => 'image_1'
            ],
            [
                'name' => 'Le Classique',
                'price' => 9.99,
                'pain' => 'pain_2',
                'oignons' => ['oignon_1'],
                'sauces' => ['sauce_2', 'sauce_3'],
                'image' => 'image_2'
            ],
            [
                'name' => 'Le Complet',
                'price' => 11.50,
                'pain' => 'pain_3',
                'oignons' => ['oignon_3'],
                'sauces' => ['sauce_3'],
                'image' => 'image_3'
            ],
            [
                'name' => 'Le Double Cheese',
                'price' => 14.50,
                'pain' => 'pain_2',
                'oignons' => [],
                'sauces' => ['sauce_2'],
                'image' => 'image_4'
            ],
            [
                'name' => 'Le Veggie',
                'price' => 10.99,
                'pain' => 'pain_3',
                'oignons' => ['oignon_1', 'oignon_2', 'oignon_3'],
                'sauces' => [],
                'image' => 'image_5'
            ],
            [
                'name' => 'Le Piquant',
                'price' => 13.99,
                'pain' => 'pain_1',
                'oignons' => ['oignon_1', 'oignon_3'],
                'sauces' => ['sauce_1'],
                'image' => 'image_6'
            ]
        ];

        foreach ($burgersData as $burgerData) {
            $burger = new Burger();
            $burger->setName($burgerData['name']);
            $burger->setPrice($burgerData['price']);
            $burger->setPain($this->getReference($burgerData['pain'], Pain::class));

            foreach ($burgerData['oignons'] as $oignonRef) {
                $burger->addOignon($this->getReference($oignonRef, Oignon::class));
            }

            foreach ($burgerData['sauces'] as $sauceRef) {
                $burger->addSauce($this->getReference($sauceRef, Sauce::class));
            }

            $burger->setImage($this->getReference($burgerData['image'], Image::class));
            $manager->persist($burger);
            
            $commentaire = new Commentaire();
            $commentaire->setName('Super burger ' . $burger->getName());
            $commentaire->setBurger($burger);
            $manager->persist($commentaire);
        }

        $manager->flush();
    }
}
