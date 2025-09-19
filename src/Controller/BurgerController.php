<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burgers_list')]
    public function list(): Response
    {
        return $this->render('burgers_list.html.twig');
    }

    #[Route('/burger/{id}', name: 'burger_show')]
    public function show(int $id): Response
    {
        // Simulation d'une liste de burgers
        $burgers = [
            1 => ['nom' => 'Burger Classique', 'description' => 'Pain, viande, salade, tomate, sauce.'],
            2 => ['nom' => 'Burger Végétarien', 'description' => 'Pain, galette végétale, salade, tomate, sauce.'],
            3 => ['nom' => 'Burger BBQ', 'description' => 'Pain, viande, oignons frits, sauce BBQ.'],
        ];

        $burger = $burgers[$id] ?? null;

        return $this->render('burger_show.html.twig', [
            'id' => $id,
            'burger' => $burger,
        ]);
    }
}
