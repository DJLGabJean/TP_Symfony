<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column] 
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Clothing::class, mappedBy:'categories')]
    #[ORM\JoinColumn(nullable: true)]
    private $clothings;

    public function __construct()
    {
        $this->clothings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getClothings(): Collection
    {
        return $this->clothings;
    }
    public function addClothing(Clothing $clothing): self
    {
        if (!$this->clothings->contains($clothing)) {
            $this->clothings[] = $clothing;
            $clothing->addCategory($this);
        }

        return $this;
    }
    public function removeClothing(Clothing $clothing): self
    {
        if ($this->clothings->removeElement($clothing)) {
            $clothing->removeCategory($this);
        }

        return $this;
    }
}


?>