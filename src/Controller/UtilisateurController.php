<?php

namespace App\Controller;

use App\Form\UtilisateurFormType;
use App\Repository\CategorieRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[IsGranted('ROLE_USER')]
class UtilisateurController extends AbstractController
{
    public function __construct(private UtilisateurRepository $utilisateurRepository, private CategorieRepository $categorieRepository)
    {

    }

    #[Route('/mon-profil', name: 'app_mon_profil')]
    public function monProfilUtilisateur(Request $request, EntityManagerInterface $manager,
                                         UserPasswordHasherInterface $passwordHasher){

        //Récupère l'utilisateur connecté ; Retourne objet de type UserInterface
        $profilUtilisateur = $this->getUser();

        //Créer un formulaire en lui donnant en premier paramètre la classe qui définit la structure du formulaire
        // et en second quel objet va remplir ses champs.
        //Permet donc de créer un formulaire prérempli avec les valeurs de l'objet
        $form = $this->createForm(UtilisateurFormType::class, $profilUtilisateur);
        //Permet de gérer la soumission du formulaire. On lui passe en paramètre la variable $request
        //qui contient les données soumises par le formulaire et on hydrate l'objet $profilUtilisateur, cad on va remplir
        // l'objet avec les données soumises par le formulaire.
        $form->handleRequest($request);

        //Vérifie si l'utilisateur soumet le formulaire
        //Et si les données dont bien valides en respectant les contraintes de validations du formulaire et/ou
        //Les contraintes de validations définit sur les propriétés de l'objet
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $form->get('password')->getData();
            $mail = $form->get('email')->getData();
            $nomPrenom = $form->get('nomPrenom')->getData();

            $passwordConfirm = $passwordHasher->hashPassword($profilUtilisateur,$password);
            $profilUtilisateur->setEmail($mail);
            $profilUtilisateur->setNomPrenom($nomPrenom);
            $profilUtilisateur->setPassword($passwordConfirm);

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $manager->persist($profilUtilisateur);

            // actually executes the queries (i.e. the INSERT query)
            $manager->flush();

            //Ajoute un message de type 'success' sur la page d'accueil
            $this->addFlash('success', 'Modification de votre profil enregistré');

            //Redirection vers la page d'accueil
            return $this->redirectToRoute('app_accueil');

        }
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
            'monProfil' => $profilUtilisateur,
            'form' => $form,
        ]);
    }
}
