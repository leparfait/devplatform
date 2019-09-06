<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 * @Vich\Uploadable
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @var File
     * @vich\UploadableField(mapping="document",fileNameProperty="nom")
     * @Assert\File(
     *    maxSize = "30M",
     *    mimeTypes = {"application/pdf", "application/x-pdf", "application/docx"},
     *    mimeTypesMessage = "Please upload a valid document format (pdf,docx)"
     * )
     */
    private $docFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Langprog", inversedBy="documents")
     */
    private $language;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    /**
     * @return null|File
     */
    public function getDocFile(): ?File
    {
        return $this->docFile;
    }

    /**
     * @param null|File $docFile
     * @return Property
     */
    public function setDocFile(?File $docFile): self
    {
        $this->docFile = $docFile;
        if($this->docFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getLanguage(): ?Langprog
    {
        return $this->language;
    }

    public function setLanguage(?Langprog $language): self
    {
        $this->language = $language;

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
}
