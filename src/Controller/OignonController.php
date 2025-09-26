<?php

namespace App\Controller;

use App\Entity\Oignon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OignonController extends AbstractController
{
    #[Route('/oignon/list', name: 'oignon_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        // Récupérer tous les oignons en base
        $oignons = $entityManager->getRepository(Oignon::class)->findAll();

        // Afficher la liste dans un template Twig (à créer : templates/oignon/list.html.twig)
        return $this->render('oignon/list.html.twig', [
            'oignons' => $oignons,
        ]);
    }

    #[Route('/oignon/create', name: 'oignon_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $oignon = new Oignon();
        $oignon->setName('Oignon rouge');

        $entityManager->persist($oignon);
        $entityManager->flush();

        return new Response('Oignon créé avec succès !');
    }
}
