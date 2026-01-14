<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProduitFixtures extends Fixture
{


    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');

        for($prod = 1; $prod <= 10; $prod++){
            $produit = new Produit();
            $produit->setName($faker->text(15));
            $produit->setDescription($faker->text());
            $produit->setSlug($this->slugger->slug($produit->getName())->lower());
            $produit->setPrice($faker->numberBetween(900, 150000));
            $produit->setStock($faker->numberBetween(0, 10));

            //On va chercher une référence de catégorie
            $category = $this->getReference('cat-'.rand(1, 8), Category::class);
            $produit->setCategory($category);

            $this->setReference('prod-'.$prod, $produit);
            $manager->persist($produit);
        }

        $manager->flush();
    }
}
