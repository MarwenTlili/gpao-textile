<?php

namespace App\Repository;

use App\Entity\PlanningHebdomadaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningHebdomadaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningHebdomadaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningHebdomadaire[]    findAll()
 * @method PlanningHebdomadaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningHebdomadaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningHebdomadaire::class);
    }

    // /**
    //  * @return PlanningHebdomadaire[] Returns an array of PlanningHebdomadaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlanningHebdomadaire
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
