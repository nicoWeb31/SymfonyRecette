<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 * @Vich\Uploadable
 */
class Type
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgage;


    /**
     * @Vich\UploadableField(mapping="type_image", fileNameProperty="imgage")
     * @var File|null
     */
    private $imgFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aliments", mappedBy="type")
     */
    private $aliments;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->aliments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getImgage(): ?string
    {
        return $this->imgage;
    }

    public function setImgage(?string $imgage): self
    {
        $this->imgage = $imgage;

        return $this;
    }

    /**
     * @return Collection|Aliments[]
     */
    public function getAliments(): Collection
    {
        return $this->aliments;
    }

    public function addAliment(Aliments $aliment): self
    {
        if (!$this->aliments->contains($aliment)) {
            $this->aliments[] = $aliment;
            $aliment->setType($this);
        }

        return $this;
    }

    public function removeAliment(Aliments $aliment): self
    {
        if ($this->aliments->contains($aliment)) {
            $this->aliments->removeElement($aliment);
            // set the owning side to null (unless already changed)
            if ($aliment->getType() === $this) {
                $aliment->setType(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setImgFile(?File $imgFile = null): self
    {
        $this->imgFile = $imgFile;

        if ($this->imgFile instanceof UploadedFile) {
            
            $this->createdAt = new \DateTime( 'now ');
        }
        return $this;
    }

    public function getImgFile(): ?File
    {
        return $this->imgFile;
    }
}
