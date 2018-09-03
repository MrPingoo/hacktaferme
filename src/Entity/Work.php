<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkRepository")
 */
class Work
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
    private $status;

    /**
     * @ORM\Column(type="text")
     */
    private $remarques = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idFMIS;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateBegin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorkParcelle", mappedBy="work", cascade={"remove"})
     */
    private $workparcelles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorkProduct", mappedBy="work", cascade={"remove"})
     */
    private $workproducts;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRemarques(): ?string
    {
        return $this->remarques;
    }

    public function setRemarques(string $remarques): self
    {
        $this->remarques = $remarques;

        return $this;
    }

    public function getIdFMIS(): ?string
    {
        return $this->idFMIS;
    }

    public function setIdFMIS(string $idFMIS): self
    {
        $this->idFMIS = $idFMIS;

        return $this;
    }

    public function getDateBegin(): ?\DateTimeInterface
    {
        return $this->dateBegin;
    }

    public function setDateBegin(\DateTimeInterface $dateBegin): self
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkparcelle()
    {
        return $this->workparcelles;
    }

    /**
     * @return mixed
     */
    public function getWorkproduct()
    {
        return $this->workproducts;
    }
}
