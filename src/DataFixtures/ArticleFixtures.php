<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // initialisation de l'objet Faker
        $faker = Factory::create('fr_FR');

        $width = 100;
        $height = 120;

        // créations des articles
        $articles = [];
        for ($i=0; $i < 20; $i++) {
            $articles[$i] = new Article();
            $articles[$i]->setLibelleArticle($faker->text(10))
                ->setDescription($faker->text)
                ->setPrix($faker->randomFloat(2, 0, 100))
                ->setQteProduit($faker->randomDigitNotNull)
                ->setImageArticle($image = $faker->imageUrl($width, $height, 'business'))
                ->setVendeur($this->getReference('user'.rand(1,5)))
                ->setCategorie($this->getReference('categorie'.rand(1, 4)));

            $manager->persist($articles[$i]);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UtilisateurFixtures::class,
            CategorieFixtures::class,
        ];
    }
}
