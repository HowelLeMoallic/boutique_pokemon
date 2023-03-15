<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $user = new Utilisateur();
        $user->setNomPrenom('John Doe');

        $user->setIdentifiant('John_Doe_35');

        $user->setEmail('johndoe@mail.com');

        $user->setCredit(1000);

        $user->setIsVerified(true);

        $password = $this->hasher->hashPassword($user, 'Pa$$w0rd');
        $user->setPassword($password);

        $this->addReference('user1', $user);

        $manager->persist($user);

        //
        $user2 = new Utilisateur();
        $user2->setNomPrenom('Professeur Chen');

        $user2->setIdentifiant('Prof-chen-Palette');

        $user2->setEmail('profChen@mail.com');

        $user2->setCredit(1000);

        $user2->setIsVerified(true);

        $password = $this->hasher->hashPassword($user2, 'Pa$$w0rd');
        $user2->setPassword($password);

        $this->addReference('user2', $user2);

        $manager->persist($user2);

        //
        $user3 = new Utilisateur();
        $user3->setNomPrenom('Martin Smith');

        $user3->setIdentifiant('MartinMatin');

        $user3->setEmail('martinsmith@mail.com');

        $user3->setCredit(1000);

        $user3->setIsVerified(true);

        $password = $this->hasher->hashPassword($user3, 'Pa$$w0rd');
        $user3->setPassword($password);

        $this->addReference('user3', $user3);

        $manager->persist($user3);

        //
        $user4 = new Utilisateur();
        $user4->setNomPrenom('John Wick');

        $user4->setIdentifiant('John_Wick_4');

        $user4->setEmail('johnwick@mail.com');

        $user4->setCredit(1000);

        $user4->setIsVerified(true);

        $password = $this->hasher->hashPassword($user4, 'Pa$$w0rd');
        $user4->setPassword($password);

        $this->addReference('user4', $user4);

        $manager->persist($user4);

        //
        $user5 = new Utilisateur();
        $user5->setNomPrenom('Le Moallic Howel');

        $user5->setIdentifiant('wewel');

        $user5->setEmail('lemoallichowel@mail.com');

        $user5->setCredit(1000000);

        $user5->setIsVerified(true);

        $password = $this->hasher->hashPassword($user5, 'Pa$$w0rd');
        $user5->setPassword($password);

        $user5->setRoles(['ROLE_ADMIN']);

        $this->addReference('user5', $user5);

        $manager->persist($user5);

        $manager->flush();

    }

}
