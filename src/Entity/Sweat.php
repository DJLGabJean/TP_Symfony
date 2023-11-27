<?php

namespace App\Entity;

use App\Repository\SweatRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: SweatRepository::class)]
class Sweat extends Clothing
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

}

?>