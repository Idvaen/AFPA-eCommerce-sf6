<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/produit', name: 'produit_')]
final class ProduitController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
        ]);
    }
    #[Route('/{slug}', name: 'details')]
    public function details(Produit $produit): Response
    {
        // dd($produit);
        return $this->render('produit/details.html.twig', compact('produit'));
    }
}
