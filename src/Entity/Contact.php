<?php

namespace App\Entity;

use App\Entity\Profil;
use Symfony\Component\Validator\Constraints as Assert; 

class Contact
{

    /**
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="/[0-9]/" 
     * )
     */
    private $phone;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;
    
    /** 
     * @var Profil|null
     */
    private $utilisateur;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

   /** 
    * @return Profil|null
    */
    public function getUtilisateur(): ?Profil
    {
        return $this->utilisateur;
    }

   /**
    * @param Profil|null $utilisateur
    * @return Contact
    */
    public function setUtilisateur(Profil $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
