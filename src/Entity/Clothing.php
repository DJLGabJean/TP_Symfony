<?php

namespace App\Entity;

use App\Repository\ClothingRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: ClothingRepository::class)]
class Clothing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'clothing')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToMany(targetEntity: Brand::class, inversedBy: 'clothings')]
    #[ORM\JoinTable(name: 'clothing_brand')]
    private $brands;

    #[ORM\ManyToMany(targetEntity: Size::class, inversedBy: 'clothings')]
    #[ORM\JoinTable(name: 'clothing_size')]
    private $sizes;

}

?>