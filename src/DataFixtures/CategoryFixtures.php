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
        $this->createCategory('Harnais', $walk, $manager);
        $this->createCategory('Laisse', $walk, $manager);
        $this->createCategory('Collier', $walk, $manager);
        $this->createCategory('Cage', $walk, $manager);
        $this->createCategory('Transport', $walk, $manager);
        $this->createCategory('Sécurité', $walk, $manager);

        $sleep = $this->createCategory('Le Coin Repos', null, $manager);
        $this->createCategory('Matelas', $sleep, $manager);
        $this->createCategory('Coussin', $sleep, $manager);
        $this->createCategory('Panier', $sleep, $manager);

        $hygiene = $this->createCategory('Hygiène et soins', null, $manager);
        $this->createCategory('Shampoing', $sleep, $manager);
        $this->createCategory('Après-shampoing', $sleep, $manager);
        $this->createCategory('Antiparasitaires', $sleep, $manager);
        $this->createCategory('Brosserie', $sleep, $manager);
        $this->createCategory('Litière', $sleep, $manager);


        $vet = $this->createCategory('Produits vétérinaires', null, $manager);
        $this->createCategory('Croquettes vétérinaires', $vet, $manager);
        $this->createCategory('Compléments alimentaires vétérinaires', $vet, $manager);
        $this->createCategory('Antiparasitaires vétérinaires', $vet, $manager);
        $this->createCategory('Soins vétérinaires', $vet, $manager);

        $manager->flush();
    }
    public function createCategory(string $name, Category $parent = null, ObjectManager $manager): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $category->setCategoryOrder($this->counter);
        $manager->persist($category);


        // Stocker la référence de la catégorie pour pouvoir la récupérer dans ProductFixtures
        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}
