<?php

// src/Controller/PanierController.php
namespace App\Controller;

use App\Entity\Panier;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    private $panierRepository;

    public function __construct(PanierRepository $panierRepository)
    {
        $this->panierRepository = $panierRepository;
    }

    /**
     * @Route("/panier", name="panier_index")
     */
    public function index(): Response
    {
        $paniers = $this->panierRepository->findAll();
        return $this->render('panier/index.html.twig', [
            'paniers' => $paniers,
        ]);
    }

    /**
     * @Route("/panier/new", name="panier_new")
     */
    public function new(Request $request): Response
    {
        $panier = new Panier();
        // Gérer le formulaire ici (ajout de produit, utilisateur, etc.)
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($panier);
        $entityManager->flush();

        return $this->redirectToRoute('panier_index');
    }

    // Ajouter d'autres actions comme edit, delete...
}
