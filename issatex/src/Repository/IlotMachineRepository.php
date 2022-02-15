<?php

namespace App\Repository;

use App\Entity\IlotMachine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IlotMachine|null find($id, $lockMode = null, $lockVersion = null)
 * @method IlotMachine|null findOneBy(array $criteria, array $orderBy = null)
 * @method IlotMachine[]    findAll()
 * @method IlotMachine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IlotMachineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IlotMachine::class);
    }

    // /**
    //  * @return IlotMachine[] Returns an array of IlotMachine objects
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
    public function findOneBySomeField($value): ?IlotMachine
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
