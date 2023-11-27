<?php

namespace App\Entity;

use App\Repository\ShoesRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: ShoesRepository::class)]
class Shoes extends Clothing
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

}

?>