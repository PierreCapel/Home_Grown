<?php

namespace App\Entity;

use App\Repository\CultureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CultureRepository::class)
 */
class Culture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlantType::class, inversedBy="cultures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plantType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $soilType;

    /**
     * @ORM\Column(type="integer")
     */
    private $seedsQty;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getSoilType(): ?string
    {
        return $this->soilType;
    }

    public function setSoilType(string $soilType): self
    {
        $this->soilType = $soilType;

        return $this;
    }

    public function getSeedsQty(): ?int
    {
        return $this->seedsQty;
    }

    public function setSeedsQty(int $seedsQty): self
    {
        $this->seedsQty = $seedsQty;

        return $this;
    }
}
