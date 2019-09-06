<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProfilRepository")
 * @Vich\Uploadable
 */
class Profil
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

         $this->language = new \Doctrine\Common\Collections\ArrayCollection();
         $this->projetrealiser = new \Doctrine\Common\Collections\ArrayCollection();
         $this->diplome = new \Doctrine\Common\Collections\ArrayCollection();
         $this->experience = new \Doctrine\Common\Collections\ArrayCollection();
         $this->projetInitier = new \Doctrine\Common\Collections\ArrayCollection();
         $this->projetParticiper = new \Doctrine\Common\Collections\ArrayCollection();

        // your own logic
    }

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNais;

    //  /**
    //  * @ORM\Column(type="string", length=100, nullable=true)
    //  */
    // private $profession;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var File|null 
     * @Assert\Image(
     *    maxSize = "4M",
     *    maxSizeMessage ="Taille du fichier très grand (maximun 4M)",
     *    mimeTypes = {"image/jpg", "image/png","image/jpeg"},
     *    mimeTypesMessage = "Please upload a valid Image format (jpg,jpeg or png)"
     * )
     * @vich\UploadableField(mapping="users_image",fileNameProperty="photo")
     */
    private $imageFile;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="profil", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserId;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diplome", mappedBy="utilisateur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $diplome;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Meslanguage", mappedBy="utilisateur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $language;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projetrealiser", mappedBy="utilisateur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $projetrealiser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="utilisateur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $experience;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="initiateur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $projetInitier;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projet", mappedBy="participant", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $projetParticiper;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(
     * pattern="/[0-9]/" 
     * )
     */
    private $telephone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNais(): ?\DateTimeInterface
    {
        return $this->dateNais;
    }

    public function setDateNais(?\DateTimeInterface $dateNais): self
    {
        $this->dateNais = $dateNais;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Property
     */
    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->UserId;
    }

    public function setUserId(User $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Diplome[]
     */
    public function getDiplome(): Collection
    {
        return $this->diplome;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->diplome->contains($diplome)) {
            $this->diplome[] = $diplome;
            $diplome->setUtilisateur($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplome->contains($diplome)) {
            $this->diplome->removeElement($diplome);
            // set the owning side to null (unless already changed)
            if ($diplome->getUtilisateur() === $this) {
                $diplome->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Meslanguage[]
     */
    public function getLanguage(): Collection
    {
        return $this->language;
    }

    public function addLanguage(Meslanguage $language): self
    {
        if (!$this->language->contains($language)) {
            $this->language[] = $language;
            $language->setUtilisateur($this);
        }

        return $this;
    }

    public function removeLanguage(Meslanguage $language): self
    {
        if ($this->language->contains($language)) {
            $this->language->removeElement($language);
            // set the owning side to null (unless already changed)
            if ($language->getUtilisateur() === $this) {
                $language->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projetrealiser[]
     */
    public function getProjetrealiser(): Collection
    {
        return $this->projetrealiser;
    }

    public function addProjetrealiser(Projetrealiser $projetrealiser): self
    {
        if (!$this->projetrealiser->contains($projetrealiser)) {
            $this->projetrealiser[] = $projetrealiser;
            $projetrealiser->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProjetrealiser(Projetrealiser $projetrealiser): self
    {
        if ($this->projetrealiser->contains($projetrealiser)) {
            $this->projetrealiser->removeElement($projetrealiser);
            // set the owning side to null (unless already changed)
            if ($projetrealiser->getUtilisateur() === $this) {
                $projetrealiser->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperience(): Collection
    {
        return $this->experience;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experience->contains($experience)) {
            $this->experience[] = $experience;
            $experience->setUtilisateur($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experience->contains($experience)) {
            $this->experience->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getUtilisateur() === $this) {
                $experience->setUtilisateur(null);
            }
        }

        return $this;
    }

    

    
    public function __toString()
    {
        return $this->getNom();
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjetInitier(): Collection
    {
        return $this->projetInitier;
    }

    public function addProjetInitier(Projet $projetInitier): self
    {
        if (!$this->projetInitier->contains($projetInitier)) {
            $this->projetInitier[] = $projetInitier;
            $projetInitier->setIntiateur($this);
        }

        return $this;
    }

    public function removeProjetInitier(Projet $projetInitier): self
    {
        if ($this->projetInitier->contains($projetInitier)) {
            $this->projetInitier->removeElement($projetInitier);
            // set the owning side to null (unless already changed)
            if ($projetInitier->getIntiateur() === $this) {
                $projetInitier->setIntiateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjetParticiper(): Collection
    {
        return $this->projetParticiper;
    }

    public function addprojetParticiper(Projet $projetParticiper): self
    {
        if (!$this->projetParticiper->contains($projetParticiper)) {
            $this->projetParticiper[] = $projetParticiper;
            $projetParticiper->setParticipant($this);
        }

        return $this;
    }

    public function removeprojetParticiper(Projet $projetParticiper): self
    {
        if ($this->projetParticiper->contains($projetParticiper)) {
            $this->projetParticiper->removeElement($projetParticiper);
            // set the owning side to null (unless already changed)
            if ($projetParticiper->getParticipant() === $this) {
                $projetParticiper->setParticipant(null);
            }
        }

        return $this;
    }
}
