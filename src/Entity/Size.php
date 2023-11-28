<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Clothing::class, mappedBy: 'sizes')]
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

    public function setName(string $name): self 
    {
        $this->name = $name;
        return $this;
    }

    public function getClothings(): Collection
    {
        return $this->clothings;
    }

    public function addClothing(Clothing $clothing): self
    {
        if (!$this->clothings->contains($clothing)) {
            $this->clothings[] = $clothing;
            $clothing->addSize($this);
        }

        return $this;
    }

    public function removeClothing(Clothing $clothing): self
    {
        if ($this->clothings->removeElement($clothing)) {
            $clothing->removeSize($this);
        }

        return $this;
    }
}