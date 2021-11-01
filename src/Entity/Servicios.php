<?php

namespace App\Entity;

use App\Repository\ServiciosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $costo;

    /**
     * @ORM\ManyToMany(targetEntity=PersonalData::class, mappedBy="Servicios")
     */
    private $personalData;

    /**
     * @ORM\OneToMany(targetEntity=Citas::class, mappedBy="servicio")
     */
    private $citas;

    public function __construct()
    {
        $this->personalData = new ArrayCollection();
        $this->citas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServicio(): ?string
    {
        return $this->servicio;
    }

    public function setServicio(string $servicio): self
    {
        $this->tipo = $servicio;

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

    /**
     * @return Collection|PersonalData[]
     */
    public function getPersonalData(): Collection
    {
        return $this->personalData;
    }

    public function addPersonalData(PersonalData $personalData): self
    {
        if (!$this->personalData->contains($personalData)) {
            $this->personalData[] = $personalData;
            $personalData->addServicio($this);
        }

        return $this;
    }

    public function removePersonalData(PersonalData $personalData): self
    {
        if ($this->personalData->removeElement($personalData)) {
            $personalData->removeServicio($this);
        }

        return $this;
    }

    /**
     * @return Collection|Citas[]
     */
    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Citas $cita): self
    {
        if (!$this->citas->contains($cita)) {
            $this->citas[] = $cita;
            $cita->setServicio($this);
        }

        return $this;
    }

    public function removeCita(Citas $cita): self
    {
        if ($this->citas->removeElement($cita)) {
            // set the owning side to null (unless already changed)
            if ($cita->getServicio() === $this) {
                $cita->setServicio(null);
            }
        }

        return $this;
    }

   
}
