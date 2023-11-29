<?php

namespace App\Repository;

use App\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BrandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('br')
            ->getQuery()
            ->getResult();
    }

    public function findOneByName(string $name): ?Brand
    {
        return $this->createQueryBuilder('br')
            ->where('br.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

?>
