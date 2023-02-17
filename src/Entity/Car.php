<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $car_id = null;

    #[ORM\Column(length: 50)]
    private ?string $car_model = null;

    #[ORM\Column(length: 100)]
    private ?string $car_series = null;

    #[ORM\Column(length: 10)]
    private ?string $car_col = null;

    #[ORM\Column(length: 10)]
    private ?string $series_col = null;

    #[ORM\Column(length: 25)]
    private ?string $car_version = null;

    #[ORM\Column(length: 255)]
    private ?string $car_image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarId(): ?string
    {
        return $this->car_id;
    }

    public function setCarId(string $car_id): self
    {
        $this->car_id = $car_id;

        return $this;
    }

    public function getCarModel(): ?string
    {
        return $this->car_model;
    }

    public function setCarModel(string $car_model): self
    {
        $this->car_model = $car_model;

        return $this;
    }

    public function getCarSeries(): ?string
    {
        return $this->car_series;
    }

    public function setCarSeries(string $car_series): self
    {
        $this->car_series = $car_series;

        return $this;
    }

    public function getCarCol(): ?string
    {
        return $this->car_col;
    }

    public function setCarCol(string $car_col): self
    {
        $this->car_col = $car_col;

        return $this;
    }

    public function getSeriesCol(): ?string
    {
        return $this->series_col;
    }

    public function setSeriesCol(string $series_col): self
    {
        $this->series_col = $series_col;

        return $this;
    }

    public function getCarVersion(): ?string
    {
        return $this->car_version;
    }

    public function setCarVersion(string $car_version): self
    {
        $this->car_version = $car_version;

        return $this;
    }

    public function getCarImage(): ?string
    {
        return $this->car_image;
    }

    public function setCarImage(string $car_image): self
    {
        $this->car_image = $car_image;

        return $this;
    }
}
