<?php

namespace App\Repository;

use App\Entity\EmployePresence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmployePresence|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployePresence|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployePresence[]    findAll()
 * @method EmployePresence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployePresenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployePresence::class);
    }

    // /**
    //  * @return EmployePresence[] Returns an array of EmployePresence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmployePresence
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
