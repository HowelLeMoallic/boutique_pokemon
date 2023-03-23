<?php

namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    public function __construct(private ArticleRepository $articleRepository, private CategorieRepository $categorieRepository)
    {
    }

    #[Route('/article', name: 'app_accueil')]
    public function index(): Response
    {
        $utilisateurEnCours = $this->getUser();

        $articles = $this->articleRepository->findAll();

        $categories = $this->categorieRepository->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'utilisateur' => $utilisateurEnCours,
        ]);
    }

    #[Route('/article/{id}', name: 'article_info')]
    public function infoArticle($id){

        $article = $this->articleRepository->find($id);

        if ($article){

            return $this->render('article/infoArticle.html.twig', [
                'article' => $article
            ]);
        }

        $this->addFlash('error', 'Cet article n\'existe pas');

        $this->addFlash('error', 'Vous n\'avez pas accès à cette sortie' );

        return $this->redirectToRoute('app_accueil');

    }
}
