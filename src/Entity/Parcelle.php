<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParcelleRepository")
 */
class Parcelle
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ilotNumber;

    /**
     * @ORM\Column(type="float")
     */
    private $surface;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idParcelleFMIS;

    /**
     * @ORM\Column(type="text")
     */
    private $coordinates;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ParcelleCulture", mappedBy="parcelle")
     */
    private $ParcelleCulture;

    public function __construct()
    {
        $this->ParcelleCulture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIlotNumber(): ?string
    {
        return $this->ilotNumber;
    }

    public function setIlotNumber(string $ilot_number): self
    {
        $this->ilotNumber = $ilot_number;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getIdParcelleFMIS(): ?string
    {
        return $this->idParcelleFMIS;
    }

    public function setIdParcelleFMIS(string $idParcelleFMIS): self
    {
        $this->idParcelleFMIS = $idParcelleFMIS;

        return $this;
    }

    /**
     * @return Collection|ParcelleCulture[]
     */
    public function getParcelleCulture(): Collection
    {
        return $this->ParcelleCulture;
    }

    public function addParcelleCulture(ParcelleCulture $parcelleCulture): self
    {
        if (!$this->ParcelleCulture->contains($parcelleCulture)) {
            $this->ParcelleCulture[] = $parcelleCulture;
            $parcelleCulture->setParcelle($this);
        }

        return $this;
    }

    public function removeParcelleCulture(ParcelleCulture $parcelleCulture): self
    {
        if ($this->ParcelleCulture->contains($parcelleCulture)) {
            $this->ParcelleCulture->removeElement($parcelleCulture);
            // set the owning side to null (unless already changed)
            if ($parcelleCulture->getParcelle() === $this) {
                $parcelleCulture->setParcelle(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param mixed $coordinates
     */
    public function setCoordinates($coordinates): void
    {
        $this->coordinates = $coordinates;
    }
}
