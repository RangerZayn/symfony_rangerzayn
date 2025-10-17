<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Pain;
use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BurgerController extends AbstractController
{
    #[Route('/burger', name: 'burger_index')]
    public function index(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findAll();

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

    #[Route('/burger/ingredient/{ingredient}', name: 'burger_by_ingredient')]
    public function findByIngredient(string $ingredient, BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findBurgersWithIngredient($ingredient);

        return $this->render('burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/top/{limit}', name: 'burger_top')]
    public function topBurgers(int $limit, BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findTopXBurgers($limit);

        return $this->render('burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }
}
