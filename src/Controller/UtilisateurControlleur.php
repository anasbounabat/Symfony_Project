<?php

// src/Controller/UtilisateurController.php
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    private $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    /**
     * @Route("/utilisateur/new", name="utilisateur_new")
     */
    public function new(Request $request): Response
    {
        $utilisateur = new Utilisateur(); // Créer un nouvel utilisateur
        $form = $this->createForm(UtilisateurType::class, $utilisateur); // Créer le formulaire

        $form->handleRequest($request); // Traiter la requête du formulaire

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur); // Persister les données dans la base
            $entityManager->flush(); // Sauvegarder les données

            // Rediriger vers la page de succès ou autre
            return $this->redirectToRoute('utilisateur_index');
        }

        // Si le formulaire n'est pas soumis ou n'est pas valide
        return $this->render('utilisateur/new.html.twig', [
            'form' => $form->createView(), // Passer le formulaire à la vue
        ]);
    }

    /**
     * @Route("/utilisateur", name="utilisateur_index")
     */
    public function index(): Response
    {
        // Récupérer tous les utilisateurs
        $utilisateurs = $this->utilisateurRepository->findAll();

        // Passer les utilisateurs à la vue pour affichage
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }
}
