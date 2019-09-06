<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InviterRepository")
 */
class Inviter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $projetId;

    /**
     * @ORM\Column(type="integer")
     */
    private $profilId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjetId(): ?int
    {
        return $this->projetId;
    }

    public function setProjetId(int $projetId): self
    {
        $this->projetId = $projetId;

        return $this;
    }

    public function getProfilId(): ?int
    {
        return $this->profilId;
    }

    public function setProfilId(int $profilId): self
    {
        $this->profilId = $profilId;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }
}
