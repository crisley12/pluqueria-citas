<?php

namespace App\Entity;

use App\Repository\PersonalDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToOne(targetEntity=Usuario::class, mappedBy="PersonalData", cascade={"persist", "remove"})
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity=Citas::class, mappedBy="PersonalData", orphanRemoval=true)
     */
    private $Citas;

    /**
     * @ORM\ManyToMany(targetEntity=Servicios::class, inversedBy="personalData")
     */
    private $Servicios;

    public function __construct()
    {
        $this->Citas = new ArrayCollection();
        $this->Servicios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        // unset the owning side of the relation if necessary
        if ($usuario === null && $this->usuario !== null) {
            $this->usuario->setPersonalData(null);
        }

        // set the owning side of the relation if necessary
        if ($usuario !== null && $usuario->getPersonalData() !== $this) {
            $usuario->setPersonalData($this);
        }

        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection|Citas[]
     */
    public function getCitas(): Collection
    {
        return $this->Citas;
    }

    public function addCita(Citas $cita): self
    {
        if (!$this->Citas->contains($cita)) {
            $this->Citas[] = $cita;
            $cita->setPersonalData($this);
        }

        return $this;
    }

    public function removeCita(Citas $cita): self
    {
        if ($this->Citas->removeElement($cita)) {
            // set the owning side to null (unless already changed)
            if ($cita->getPersonalData() === $this) {
                $cita->setPersonalData(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Servicios[]
     */
    public function getServicios(): Collection
    {
        return $this->Servicios;
    }

    public function addServicio(Servicios $servicio): self
    {
        if (!$this->Servicios->contains($servicio)) {
            $this->Servicios[] = $servicio;
        }

        return $this;
    }

    public function removeServicio(Servicios $servicio): self
    {
        $this->Servicios->removeElement($servicio);

        return $this;
    }
}
