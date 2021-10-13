<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cliente_data;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $personal_data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    public function getClienteData(): ?string
    {
        return $this->cliente_data;
    }

    public function setClienteData(string $cliente_data): self
    {
        $this->cliente_data = $cliente_data;

        return $this;
    }

    public function getPersonalData(): ?string
    {
        return $this->personal_data;
    }

    public function setPersonalData(string $personal_data): self
    {
        $this->personal_data = $personal_data;

        return $this;
    }
}
