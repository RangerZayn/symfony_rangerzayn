<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Pain;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BurgerController extends AbstractController
{
    #[Route('/burger', name: 'burger_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $burgers = $entityManager->getRepository(Burger::class)->findAll();

        return $this->render('burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/create', name: 'burger_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        // Récupération d'un Pain existant, ici avec l'ID = 1
        $pain = $entityManager->getRepository(Pain::class)->find(1);
        if (!$pain) {
            return new Response('Pain introuvable, créez-en un d’abord.', 404);
        }

        $burger = new Burger();
        $burger->setName('Krabby Patty');
        $burger->setPrice(4.99);

        $entityManager->persist($burger);
        $entityManager->flush();

        return new Response('Burger créé avec succès !');
    }

}
