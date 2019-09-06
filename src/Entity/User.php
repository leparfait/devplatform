<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user", "user:read"}},
 *     denormalizationContext={"groups"={"user", "user:write"}}
 * )
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Profil", mappedBy="UserId", cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @Groups({"user"})
     */
    protected $email;


    /**
     * @Groups({"user:write"})
     */
    protected $plainPassword;

    /**
     * @Groups({"user"})
     */
    protected $username;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", mappedBy="users")
     */
    private $groupes;

    public function __construct()
    {
        parent::__construct();
        $this->groupes = new ArrayCollection();
    }

    // /**
    //  * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", mappedBy="users")
    //  */
    // private $groupes;

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->groupes = new ArrayCollection();
    // }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(Profil $profil): self
    {
        $this->profil = $profil;

        // set the owning side of the relation if necessary
        if ($this !== $profil->getUserId()) {
            $profil->setUserId($this);
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addUser($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeUser($this);
        }

        return $this;
    }

    public function isUser(UserInterface $user = null)
    {
        return $user instanceof self && $user->id === $this->id;
    }

}