<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductFixtures extends Fixture
{
    public function  __construct(
        private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($prod = 1; $prod <= 100; $prod++) {
            $newProduct = new Product();
            $newProduct->setName($faker->text(15, true));
            $newProduct->setDescription($faker->paragraphs(2, true));
            $newProduct->setSlug($this->slugger->slug($newProduct->getName())->lower());
            $newProduct->setPrice($faker->numberBetween( 900, 150000));
            $newProduct->setStock($faker->numberBetween(0,10));
            $newProduct->setCreatedAt(date_create_immutable());

            // On récupère une catégorie aléatoire
            $category = $this->getReference(('cat-'.rand(2, 25)));
            $newProduct->setCategory($category);

            $this->setReference('prod-'.$prod, $newProduct);
            $manager->persist($newProduct);
        }

        $manager->flush();
    }
}
