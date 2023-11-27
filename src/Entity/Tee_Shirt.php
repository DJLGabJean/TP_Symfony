<?php

namespace App\Entity;

use App\Repository\Tee_ShirtRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: Tee_ShirtRepository::class)]
class Tee_Shirt extends Clothing
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;
    
}

?>