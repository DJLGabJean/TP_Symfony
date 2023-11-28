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

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'brand')]
    private $category;

    #[ORM\ManyToMany(targetEntity: Brand::class, inversedBy: 'clothings')]
    #[ORM\JoinTable(name: 'clothing_brand')]
    private $brands;

    #[ORM\ManyToMany(targetEntity: Size::class, inversedBy: 'clothings')]
    #[ORM\JoinTable(name: 'clothing_size')]
    private $sizes;

    public function __construct()
    {
        $this->brands = new ArrayCollection();
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


    public function getCategory() : ?Category
    {
        return $this->category;
    }
    public function setCategory($category) : self
    {
        $this->category = $category;
        return $this;
    }


    public function getBrands() : Collection
    {
        return $this->brands;
    }
    public function addBrand(Brand $brand): self
    {
        if (!$this->brands->contains($brand)) {
            $this->brands[] = $brand;
            $brand->addClothing($this);
        }

        return $this;
    }
    public function removeBrand(Brand $brand): self
    {
        if ($this->brands->removeElement($brand)) {
            $brand->removeClothing($this);
        }

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