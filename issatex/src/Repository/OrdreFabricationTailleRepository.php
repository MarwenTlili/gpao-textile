<?php

namespace App\Repository;

use App\Entity\OrdreFabricationTaille;
use App\Entity\Taille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdreFabricationTaille|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdreFabricationTaille|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdreFabricationTaille[]    findAll()
 * @method OrdreFabricationTaille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdreFabricationTailleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdreFabricationTaille::class);
    }

    public function findByOrdreFabrication($ordreFabrication)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('ordreFabrication', 'taille')
            ->from(Taille::class, 't')
            ->from(OrdreFabricationTaille::class, 'o')
            ->andWhere('o.ordreFabrication = :of')
            ->setParameter('of', $ordreFabrication)
            // ->orderBy('o.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return OrdreFabricationTaille[] Returns an array of OrdreFabricationTaille objects
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
    public function findOneBySomeField($value): ?OrdreFabricationTaille
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
