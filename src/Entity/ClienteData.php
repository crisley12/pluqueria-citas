<?php

namespace App\Entity;

use App\Repository\ClienteDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteDataRepository::class)
 */
class ClienteData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Usuario::class, mappedBy="clienteData", cascade={"persist", "remove"})
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity=Citas::class, mappedBy="clienteData", orphanRemoval=true)
     */
    private $Citas;

    public function __construct()
    {
        $this->Citas = new ArrayCollection();
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
            $this->usuario->setClienteData(null);
        }

        // set the owning side of the relation if necessary
        if ($usuario !== null && $usuario->getClienteData() !== $this) {
            $usuario->setClienteData($this);
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
            $cita->setClienteData($this);
        }

        return $this;
    }

    public function removeCita(Citas $cita): self
    {
        if ($this->Citas->removeElement($cita)) {
            // set the owning side to null (unless already changed)
            if ($cita->getClienteData() === $this) {
                $cita->setClienteData(null);
            }
        }

        return $this;
    }
}
