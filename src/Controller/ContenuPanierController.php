<?php

// src/Controller/ContenuPanierController.php
namespace App\Controller;

use App\Entity\ContenuPanier;
use App\Repository\ContenuPanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContenuPanierController extends AbstractController
{
    private $contenuPanierRepository;

    public function __construct(ContenuPanierRepository $contenuPanierRepository)
    {
        $this->contenuPanierRepository = $contenuPanierRepository;
    }

    /**
     * @Route("/contenu-panier", name="contenu_panier_index")
     */
    public function index(): Response
    {
        $contenuPaniers = $this->contenuPanierRepository->findAll();
        return $this->render('contenu_panier/index.html.twig', [
            'contenuPaniers' => $contenuPaniers,
        ]);
    }

    /**
     * @Route("/contenu-panier/new", name="contenu_panier_new")
     */
    public function new(Request $request): Response
    {
        $contenuPanier = new ContenuPanier();
        // Gérer le formulaire ici (ajout de produit, panier, etc.)
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contenuPanier);
        $entityManager->flush();

        return $this->redirectToRoute('contenu_panier_index');
    }

    // Ajouter d'autres actions comme edit, delete...
}
