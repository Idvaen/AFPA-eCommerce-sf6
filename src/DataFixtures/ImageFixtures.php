<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($img = 1; $img <= 100; $img++){
            $image = new Image();
            $image->setName('/tmp/'.$faker->text(15).'png');
            $produit = $this->getReference(name: 'prod-'.rand(1, 10), class: Produit::class);
            $image->setProduit($produit);
            $manager->persist($image);
        }

        $manager->flush();
    }

    public function getDependencies():array{
        return [
            ProduitFixtures::class
        ];
    }
}
