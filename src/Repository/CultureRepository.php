<?php

namespace App\Repository;

use App\Entity\Culture;
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

    public function keepHarvestedUpdated(Culture $culture)
    {
        $today = new DateTime('now');
        $daysFromHarvest = new DateInterval("P" . $culture->getPlantType()->getDaysToHarvest() . "D");
        $startDate = new DateTime($culture->getStartDate()->format('Y-m-d H:i:s'));
        $harvestDate = $startDate->add($daysFromHarvest);
        // dd($harvestDate);
        if ($today > $harvestDate) {
            $culture->setHarvested(true);
        }
    }

}
