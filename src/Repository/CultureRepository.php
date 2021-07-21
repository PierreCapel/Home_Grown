<?php

namespace App\Repository;

use App\Entity\Culture;
use App\Entity\PlantNeeds;
use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Culture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Culture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Culture[]    findAll()
 * @method Culture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CultureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Culture::class);
    }
    
    public function findCultureStage(Culture $culture)
    {
        $now = new DateTime('now');
        $cultureStartDate = new DateTime($culture->getStartDate()->format('Y M D'));
        $threeDays = new DateInterval('P3D');
        $fourWeeks = new DateInterval('P28D');
        $twelveWeeks = new DateInterval('P84D');
        $sproutEnd = $cultureStartDate->add($threeDays);
        $growthEnd = $cultureStartDate->add($fourWeeks);
        $floweringEnd = $cultureStartDate->add($twelveWeeks);

        if ($now < $sproutEnd ) {
            return 'sprout';
        } elseif ($now > $sproutEnd && $now < $growthEnd) {
            return 'growth';
        } else if ($now > $growthEnd && $now < $floweringEnd) {
            return 'flowering';
        } else {
            return 'already harvested!';
        }
    }

    public function findPlantNeedsByCultureStage(Culture $culture)
    {
        return $this->createQueryBuilder('plantNeeds')
        ->andWhere('plantNeeds.cultureStage = :cultureStage')
        ->andWhere('plantNeeds.plantType = :plantType')
        ->setParameter('cultureStage', $this->findCultureStage($culture))
        ->setParameter('plantType', $culture->getPlantType())
        ->getQuery()
        ->getResult();
    }




    // /**
    //  * @return Culture[] Returns an array of Culture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Culture
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
