<?php

namespace App\Entity;

use App\Repository\CitasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitasRepository::class)
 */
class Citas
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
    private $hora_inicio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hora_fin;

    /**
     * @ORM\Column(type="integer")
     */
    private $cliente_data_id;

     /**
     * @ORM\Column(type="integer")
     */
    private $telefono;

    /**
     * @ORM\Column(type="integer")
     */
    private $personal_data_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $servicios_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClienteDataId(): ?int
    {
        return $this->cliente_data_id;
    }

    public function setClienteDataId(int $cliente_data_id): self
    {
        $this->cliente_data_id = $cliente_data_id;

        return $this;
    }

    public function getPersonalDataId(): ?int
    {
        return $this->personal_data_id;
    }

    public function setPersonalDataId(int $personal_data_id): self
    {
        $this->personal_data_id = $personal_data_id;

        return $this;
    }

    public function getServiciosId(): ?int
    {
        return $this->servicios_id;
    }

    public function setServiciosId(int $servicios_id): self
    {
        $this->servicios_id = $servicios_id;

        return $this;
    }
}
