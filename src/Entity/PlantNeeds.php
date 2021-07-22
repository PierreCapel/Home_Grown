<?php

namespace App\Entity;

use App\Repository\PlantNeedsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlantNeedsRepository::class)
 */
class PlantNeeds
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $light;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $waterPerDay;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cultureStage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minTemperature;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $targetPH;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $targetEC;

    /**
     * @ORM\ManyToOne(targetEntity=PlantType::class, inversedBy="plantNeeds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plantType;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxTemperature;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minHumidity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxHumidity;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getLight(): ?int
    {
        return $this->light;
    }

    public function setLight(int $light): self
    {
        $this->light = $light;

        return $this;
    }

    public function getWaterPerDay(): ?float
    {
        return $this->waterPerDay;
    }

    public function setWaterPerDay(float $waterPerDay): self
    {
        $this->waterPerDay = $waterPerDay;

        return $this;
    }

    public function getCultureStage(): ?string
    {
        return $this->cultureStage;
    }

    public function setCultureStage(string $cultureStage): self
    {
        $this->cultureStage = $cultureStage;

        return $this;
    }

    public function getMinTemperature(): ?int
    {
        return $this->minTemperature;
    }

    public function setMinTemperature(int $minTemperature): self
    {
        $this->minTemperature = $minTemperature;

        return $this;
    }

    public function getTargetPH(): ?float
    {
        return $this->targetPH;
    }

    public function setTargetPH(float $targetPH): self
    {
        $this->targetPH = $targetPH;

        return $this;
    }

    public function getTargetEC(): ?float
    {
        return $this->targetEC;
    }

    public function setTargetEC(float $targetEC): self
    {
        $this->targetEC = $targetEC;

        return $this;
    }

    public function getPlantType(): ?PlantType
    {
        return $this->plantType;
    }

    public function setPlantType(?PlantType $plantType): self
    {
        $this->plantType = $plantType;

        return $this;
    }

    public function getMaxTemperature(): ?int
    {
        return $this->maxTemperature;
    }

    public function setMaxTemperature(int $maxTemperature): self
    {
        $this->maxTemperature = $maxTemperature;

        return $this;
    }

    public function getMinHumidity(): ?int
    {
        return $this->minHumidity;
    }

    public function setMinHumidity(?int $minHumidity): self
    {
        $this->minHumidity = $minHumidity;

        return $this;
    }

    public function getMaxHumidity(): ?int
    {
        return $this->maxHumidity;
    }

    public function setMaxHumidity(?int $maxHumidity): self
    {
        $this->maxHumidity = $maxHumidity;

        return $this;
    }
}
