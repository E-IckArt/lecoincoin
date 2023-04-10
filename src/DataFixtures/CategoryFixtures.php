<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    private $counter = 1;

    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $food = $this->createCategory('Nourriture', null, $manager);
        $this->createCategory('Croquettes', $food, $manager);
        $this->createCategory('Produits frais', $food, $manager);
        $this->createCategory('Compléments alimentaires', $food, $manager);
        $this->createCategory('Gamelles', $food, $manager);
        $this->createCategory('Récompenses et friandises', $food, $manager);
        $this->createCategory('Alimentation Vétérinaire', $food, $manager);

        $toys = $this->createCategory('Jeux', null, $manager);
        $this->createCategory('Intelligent', $toys, $manager);
        $this->createCategory('A mordiller', $toys, $manager);
        $this->createCategory('Peluche', $toys, $manager);
        $this->createCategory('Balles', $toys, $manager);
        $this->createCategory('A lancer', $toys, $manager);
        $this->createCategory('Jeux d\'eau', $toys, $manager);

        $walk = $this->createCategory('Promenade', null, $manager);
        $sleep = $this->createCategory('Le Coin Repos', null, $manager);
        $hygiene = $this->createCategory('Hygiène et soins', null, $manager);
        $vet = $this->createCategory('Produits vétérinaires', null, $manager);

        $manager->flush();
    }
    public function createCategory(string $name, Category $parent = null, ObjectManager $manager): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $manager->persist($category);


        // Stocker la référence de la catégorie pour pouvoir la récupérer dans ProductFixtures
        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}
