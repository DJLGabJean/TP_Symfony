<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Clothing::class, mappedBy: 'brand')]
    private Collection $clothings;

    public function __construct()
    {
        $this->clothings = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName() : ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function getClothing() : Collection
    {
        return $this->clothings;
    }
    public function addClothing(Clothing $clothing): self
    {
        if (!$this->clothings->contains($clothing)) {
            $this->clothings[] = $clothing;
            $clothing->setBrand($this);
        }

        return $this;
    }
    public function removeClothing(Clothing $clothing): self
    {
        if ($this->clothings->removeElement($clothing)) {

            if ($clothing->getBrand() === $this) {
                $clothing->setBrand(null);
            }
        }

        return $this;
    }

}

?>