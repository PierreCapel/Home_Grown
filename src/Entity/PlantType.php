<?php

namespace App\Entity;

use App\Repository\PlantTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlantTypeRepository::class)
 */
class PlantType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=PlantNeeds::class, mappedBy="plantType")
     */
    private $plantNeeds;

    /**
     * @ORM\OneToMany(targetEntity=Culture::class, mappedBy="plantType")
     */
    private $cultures;

    /**
     * @ORM\Column(type="integer")
     */
    private $daysBeforeHarvest;

    public function __construct()
    {
        $this->plantNeeds = new ArrayCollection();
        $this->cultures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|PlantNeeds[]
     */
    public function getPlantNeeds(): Collection
    {
        return $this->plantNeeds;
    }

    public function addPlantNeed(PlantNeeds $plantNeed): self
    {
        if (!$this->plantNeeds->contains($plantNeed)) {
            $this->plantNeeds[] = $plantNeed;
            $plantNeed->setPlantType($this);
        }

        return $this;
    }

    public function removePlantNeed(PlantNeeds $plantNeed): self
    {
        if ($this->plantNeeds->removeElement($plantNeed)) {
            // set the owning side to null (unless already changed)
            if ($plantNeed->getPlantType() === $this) {
                $plantNeed->setPlantType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Culture[]
     */
    public function getCultures(): Collection
    {
        return $this->cultures;
    }

    public function addCulture(Culture $culture): self
    {
        if (!$this->cultures->contains($culture)) {
            $this->cultures[] = $culture;
            $culture->setPlantType($this);
        }

        return $this;
    }

    public function removeCulture(Culture $culture): self
    {
        if ($this->cultures->removeElement($culture)) {
            // set the owning side to null (unless already changed)
            if ($culture->getPlantType() === $this) {
                $culture->setPlantType(null);
            }
        }

        return $this;
    }

    public function getDaysBeforeHarvest(): ?int
    {
        return $this->daysBeforeHarvest;
    }

    public function setDaysBeforeHarvest(int $daysBeforeHarvest): self
    {
        $this->daysBeforeHarvest = $daysBeforeHarvest;

        return $this;
    }
}
