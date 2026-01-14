<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category', name: 'category_')]
final class CategoryController extends AbstractController
{
    #[Route('/{slug}', name: 'list')]
    public function list(Category $category): Response
    {
        //On va chercher la liste des produits de la categorie
        $produits = $category->getProduits();
        return $this->render(
            'category/list.html.twig',
            compact('category', 'produits')
        );
        // Alternative
        // return $this->render(
        //     'category/list.html.twig',
        //     [
        //         'category' => $category,
        //         'produits' => $produits
        //     ]
        // );
    }
}
