<?php

// src/Controller/ProduitController.php
namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProduitController extends AbstractController
{
    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    /**
     * @Route("/produit/new", name="produit_new")
     */
    public function new(Request $request): Response
    {
        $produit = new Produit(); // Créer un nouvel objet Produit
        $form = $this->createForm(ProduitType::class, $produit); // Créer le formulaire

        $form->handleRequest($request); // Traiter la requête du formulaire

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData(); // Récupérer le fichier photo
            if ($photoFile) {
                // Gérer le téléchargement de la photo (par exemple, déplacer le fichier sur le serveur)
                $newFilename = uniqid() . '.' . $photoFile->guessExtension();
                $photoFile->move(
                    $this->getParameter('produit_photos_directory'), // Dossier où stocker les images
                    $newFilename
                );
                // Enregistrer le nom de la photo dans l'entité Produit
                $produit->setPhoto($newFilename);
            }

            // Persister le produit dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            // Rediriger vers la page de succès ou la liste des produits
            return $this->redirectToRoute('produit_index');
        }

        // Si le formulaire n'est pas soumis ou n'est pas valide
        return $this->render('produit/new.html.twig', [
            'form' => $form->createView(), // Passer le formulaire à la vue
        ]);
    }

    /**
     * @Route("/produit", name="produit_index")
     */
    public function index(): Response
    {
        // Récupérer tous les produits
        $produits = $this->produitRepository->findAll();

        // Passer les produits à la vue pour affichage
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }
}
