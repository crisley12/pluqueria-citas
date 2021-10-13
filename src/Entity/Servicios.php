<?php

namespace App\Entity;

use App\Repository\ServiciosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiciosRepository::class)
 */
class Servicios
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
    private $servicio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hora_inicio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hora_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $costo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->servicios;
    }

    public function setTipo(string $servicios): self
    {
        $this->tipo = $servicios;

        return $this;
    }

    public function getHoraInicio(): ?string
    {
        return $this->hora_inicio;
    }

    public function setHoraInicio(string $hora_inicio): self
    {
        $this->hora_inicio = $hora_inicio;

        return $this;
    }

    public function getHoraFin(): ?string
    {
        return $this->hora_fin;
    }

    public function setHoraFin(string $hora_fin): self
    {
        $this->hora_fin = $hora_fin;

        return $this;
    }

    public function getCosto(): ?string
    {
        return $this->costo;
    }

    public function setCosto(string $costo): self
    {
        $this->costo = $costo;

        return $this;
    }
}
