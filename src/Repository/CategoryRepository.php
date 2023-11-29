<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('ca')
            ->getQuery()
            ->getResult();
    }

    public function findOneByName(string $name): ?Category
    {
        return $this->createQueryBuilder('ca')
            ->where('ca.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

?>
