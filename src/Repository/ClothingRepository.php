<?php

namespace App\Repository;

use App\Entity\Clothing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClothingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clothing::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('cl')
            ->getQuery()
            ->getResult();
    }

    public function findOneByName(string $name): ?Clothing
    {
        return $this->createQueryBuilder('cl')
            ->where('cl.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

?>
