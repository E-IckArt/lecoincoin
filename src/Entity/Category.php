<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'category')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $category;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private Collection $product;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(self $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }

//    public function __toString(): string
//    {
//        return $this->name;
//    }

/**
 * @return Collection<int, Product>
 */
public function getProduct(): Collection
{
    return $this->product;
}

public function addProduct(Product $product): self
{
    if (!$this->product->contains($product)) {
        $this->product->add($product);
        $product->setCategory($this);
    }

    return $this;
}

public function removeProduct(Product $product): self
{
    if ($this->product->removeElement($product)) {
        // set the owning side to null (unless already changed)
        if ($product->getCategory() === $this) {
            $product->setCategory(null);
        }
    }

    return $this;
}
}
