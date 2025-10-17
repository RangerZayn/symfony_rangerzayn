<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    public function findBurgersWithIngredient(string $ingredient): array
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.oignons', 'o')
            ->where('o.name = :ingredient')
            ->setParameter('ingredient', $ingredient)
            ->getQuery()
            ->getResult();
    }

    public function findTopXBurgers(int $limit): array
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.price', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
