<?php

namespace App\Repository;

use App\Entity\Culture;
use App\Entity\PlantNeeds;
use DateInterval;
use DateTime;
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

    public function findCultureStage(Culture $culture)
    {
        $now = new DateTime('now');
        $cultureStartDate = new DateTime($culture->getStartDate()->format('D M Y'));
        $daysToGrowth = new DateInterval('P' . $culture->getPlantType()->getDaysToGrowth() . 'D');
        $daysToFlowering = new DateInterval('P' . $culture->getPlantType()->getDaysToFlowering() . 'D');
        $daysToHarvest = new DateInterval('P' . $culture->getPlantType()->getDaysToHarvest() .'D');
        $sproutEnd = $cultureStartDate->add($daysToGrowth);
        $cultureStartDate = new DateTime($culture->getStartDate()->format('D M Y'));
        $growthEnd = $cultureStartDate->add($daysToFlowering);
        $cultureStartDate = new DateTime($culture->getStartDate()->format('D M Y'));
        $floweringEnd = $cultureStartDate->add($daysToHarvest);

        if ($now < $sproutEnd ) {
            return 'sprout';
        } elseif ($now > $sproutEnd && $now < $growthEnd) {
            return 'growth';
        } else if ($now > $growthEnd && $now < $floweringEnd) {
            return 'flowering';
        } else {
            return 'already harvested';
        }
    }

    public function findPlantNeedsByCultureStage(Culture $culture)
    {
        return $this->createQueryBuilder('plantNeeds')
        ->andWhere('plantNeeds.cultureStage = :cultureStage')
        // ->andWhere('plantNeeds.plantType = :plantType')
        ->setParameter('cultureStage', $this->findCultureStage($culture))
        // ->setParameter('plantType', $culture->getPlantType())
        ->getQuery()
        ->getResult();
    }

    public function findHarvestDate(Culture $culture)
    {
        $cultureStartDate = new DateTime($culture->getStartDate()->format('D M Y'));
        $daysToHarvest = new DateInterval('P' . $culture->getPlantType()->getDaysToHarvest() . 'D');
        return $cultureStartDate->add($daysToHarvest);
    }

}
