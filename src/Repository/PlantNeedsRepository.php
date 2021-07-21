<?php

namespace App\Repository;

use App\Entity\PlantNeeds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlantNeeds|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlantNeeds|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlantNeeds[]    findAll()
 * @method PlantNeeds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlantNeedsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlantNeeds::class);
    }

    // /**
    //  * @return PlantNeeds[] Returns an array of PlantNeeds objects
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
    public function findOneBySomeField($value): ?PlantNeeds
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
