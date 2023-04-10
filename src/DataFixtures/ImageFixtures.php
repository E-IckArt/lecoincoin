<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    // Permet d'indiquer toutes les fixtures à exécuter avant celle-ci
    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($img = 1; $img <= 10; $img++) {
            $newImage = new Image();
            $newImage->setName($faker->text(15));

            // On récupère un produit aléatoire
            $product = $this->getReference(('prod-'.rand(1, 10)));
            $newImage->setProduct($product);

            $manager->persist($newImage);
        }
        $manager->flush();
    }
}
