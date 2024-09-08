<?php

namespace App\Repository;

use App\Entity\Ilot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ilot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ilot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ilot[]    findAll()
 * @method Ilot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IlotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ilot::class);
    }

    // /**
    //  * @return Ilot[] Returns an array of Ilot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ilot
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
