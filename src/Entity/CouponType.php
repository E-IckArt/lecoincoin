<?php

namespace App\Entity;

use App\Repository\CouponTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponTypeRepository::class)]
class CouponType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'coupon_type', targetEntity: CouponReduction::class, orphanRemoval: true)]
    private Collection $couponReduction;

    public function __construct()
    {
        $this->couponReduction = new ArrayCollection();
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

    /**
     * @return Collection<int, CouponReduction>
     */
    public function getCouponReduction(): Collection
    {
        return $this->couponReduction;
    }

    public function addCouponReduction(CouponReduction $couponReduction): self
    {
        if (!$this->couponReduction->contains($couponReduction)) {
            $this->couponReduction->add($couponReduction);
            $couponReduction->setCouponType($this);
        }

        return $this;
    }

    public function removeCouponReduction(CouponReduction $couponReduction): self
    {
        if ($this->couponReduction->removeElement($couponReduction)) {
            // set the owning side to null (unless already changed)
            if ($couponReduction->getCouponType() === $this) {
                $couponReduction->setCouponType(null);
            }
        }

        return $this;
    }
}
