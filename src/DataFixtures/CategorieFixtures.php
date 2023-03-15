<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categorie1 = new Categorie();

        $categorie1->setLibelleCategorie('Potions');

        $this->addReference('categorie1', $categorie1);

        $manager->persist($categorie1);

        //
        $categorie4 = new Categorie();

        $categorie4->setLibelleCategorie('Baies');

        $this->addReference('categorie4', $categorie4);

        $manager->persist($categorie4);

        //
        $categorie2 = new Categorie();

        $categorie2->setLibelleCategorie('Poké Balls');

        $this->addReference('categorie2', $categorie2);

        $manager->persist($categorie2);

        //
        $categorie3 = new Categorie();

        $categorie3->setLibelleCategorie('Tenues');

        $this->addReference('categorie3', $categorie3);

        $manager->persist($categorie3);

        $manager->flush();
    }
}
