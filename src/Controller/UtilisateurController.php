<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    public function __construct(private UtilisateurRepository $utilisateurRepository)
    {

    }

    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    #[Route('/mon-profil/{id}', name: 'app_mon_profil')]
    public function monProfilUtilisateur($id){

        $profilUtilisateur = $this->utilisateurRepository->find($id);

        return $this->render('utilisateur/index.html.twig', [
           'controller_name' => 'UtilisateurController',
           'monProfil' => $profilUtilisateur,
        ]);
    }
}
