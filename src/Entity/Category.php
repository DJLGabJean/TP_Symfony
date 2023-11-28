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

    #[ORM\OneToMany(targetEntity: Clothing::class, mappedBy:'category')]
    #[ORM\JoinColumn(nullable: true)]
    private $clothing;

    public function __construct()
    {
        $this->clothing = new ArrayCollection();
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

    public function getClothing(): Collection
    {
        return $this->clothing;
    }

    public function addClothing(Clothing $clothing): void
    {
        if (!$this->clothing->contains($clothing)) {
            $this->clothing[] = $clothing;
            $clothing->setCategory($this);
        }
    }

    public function removeClothing(Clothing $clothing): void
    {
        if ($this->clothing->contains($clothing)) {
            $this->clothing->removeElement($clothing);
     
            if ($clothing->getCategory() === $this) {
                $clothing->setCategory(null);
            }
        }
    }
}


?>