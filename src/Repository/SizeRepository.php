<?php

namespace App\Repository;

use App\Entity\Size;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Size::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('si')
            ->getQuery()
            ->getResult();
    }

    public function findOneByName(string $name): ?Size
    {
        return $this->createQueryBuilder('si')
            ->where('si.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

?>
