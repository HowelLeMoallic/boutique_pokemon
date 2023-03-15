<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(ArticleRepository $articleRepository, CategorieRepository $categorieRepository): Response
    {
        $articles = $articleRepository->findAll();

        $categories = $categorieRepository->findAll();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
