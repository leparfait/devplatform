<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeslanguageRepository")
 */
class Meslanguage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function __construct()
    {
        //parent::__construct();

         $this->utilisateur = new \Doctrine\Common\Collections\ArrayCollection();

        // your own logic
    }

    /**
     * @ORM\Column(type="integer")
     */

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Langprog", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $languageId;

   
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil", inversedBy="language")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $niveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getLanguageId(): ?Langprog
    {
        return $this->languageId;
    }

    public function setLanguageId(Langprog $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getUtilisateur(): ?Profil
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Profil $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
