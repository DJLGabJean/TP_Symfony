<?php

namespace App\Entity;

use App\Repository\ClothingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClothingRepository::class)]
class Clothing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'clothings')]
    #[ORM\JoinTable(name: 'clothing_category')]
    private $categories;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'clothings')]
    private $brand;

    #[ORM\ManyToMany(targetEntity: Size::class, inversedBy: 'clothings')]
    #[ORM\JoinTable(name: 'clothing_size')]
    private $sizes;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->sizes = new ArrayCollection();
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


    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addClothing($this);
        }

        return $this;
    }
    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeClothing($this);
        }

        return $this;
    }


    public function getBrand() : ?Brand
    {
        return $this->brand;
    }

    public function setBrand($brand) : self
    {
        $this->brand = $brand;
        return $this;
    }


    public function getSizes() : Collection 
    {
        return $this->sizes;
    }
    public function addSize(Size $size): self
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes[] = $size;
            $size->addClothing($this);
        }

        return $this;
    }
    public function removeSize(Size $size): self
    {
        if ($this->sizes->removeElement($size)) {
            $size->removeClothing($this);
        }

        return $this;
    }
}

?>