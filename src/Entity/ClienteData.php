<?php

namespace App\Entity;

use App\Repository\ClienteDataRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private $citas;

    public function getId(): ?int
    {
        return $this->id;
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
