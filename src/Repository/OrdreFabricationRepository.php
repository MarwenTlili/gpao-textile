<?php

namespace App\Repository;

use App\Entity\OrdreFabrication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdreFabrication|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdreFabrication|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdreFabrication[]    findAll()
 * @method OrdreFabrication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdreFabricationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdreFabrication::class);
    }

    // /**
    //  * @return OrdreFabrication[] Returns an array of OrdreFabrication objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrdreFabrication
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
