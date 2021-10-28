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
     * @ORM\Column(type="time")
     */
    private $hora;

    /**
     * @ORM\ManyToOne(targetEntity=ClienteData::class, inversedBy="Citas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clienteData;

    /**
     * @ORM\ManyToOne(targetEntity=PersonalData::class, inversedBy="Citas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $PersonalData;

    /**
     * @ORM\Column(type="date")
     */
    private $Fecha;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $telefono;

    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): self
    {
        $this->hora = $hora;

        return $this;
    }

    public function getClienteData(): ?ClienteData
    {
        return $this->clienteData;
    }

    public function setClienteData(?ClienteData $clienteData): self
    {
        $this->clienteData = $clienteData;

        return $this;
    }

    public function getPersonalData(): ?PersonalData
    {
        return $this->PersonalData;
    }

    public function setPersonalData(?PersonalData $PersonalData): self
    {
        $this->PersonalData = $PersonalData;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

}
