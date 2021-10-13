<?php

namespace App\Entity;

use App\Repository\PersonalDataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonalDataRepository::class)
 */
class PersonalData
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
    private $servicios;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $citas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServicios(): ?string
    {
        return $this->servicios;
    }

    public function setServicios(string $servicios): self
    {
        $this->servicios = $servicios;

        return $this;
    }

    public function getCitas(): ?string
    {
        return $this->citas;
    }

    public function setCitas(string $citas): self
    {
        $this->citas = $citas;

        return $this;
    }
}
