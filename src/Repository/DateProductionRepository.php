<?php

namespace App\Repository;

use App\Entity\DateProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DateProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateProduction[]    findAll()
 * @method DateProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateProduction::class);
    }

    // /**
    //  * @return DateProduction[] Returns an array of DateProduction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateProduction
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
