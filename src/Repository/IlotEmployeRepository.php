<?php

namespace App\Repository;

use App\Entity\IlotEmploye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IlotEmploye|null find($id, $lockMode = null, $lockVersion = null)
 * @method IlotEmploye|null findOneBy(array $criteria, array $orderBy = null)
 * @method IlotEmploye[]    findAll()
 * @method IlotEmploye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IlotEmployeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IlotEmploye::class);
    }

    // /**
    //  * @return IlotEmploye[] Returns an array of IlotEmploye objects
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
    public function findOneBySomeField($value): ?IlotEmploye
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
