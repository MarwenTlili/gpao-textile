<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     */
    private $montantTotale;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $facturedAt;

    /**
     * @ORM\OneToMany(targetEntity=OrdreFabrication::class, mappedBy="Facture")
     */
    private $ordreFabrications;

    public function __construct()
    {
        $this->ordreFabrications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMontantTotale(): ?string
    {
        return $this->montantTotale;
    }

    public function setMontantTotale(?string $montantTotale): self
    {
        $this->montantTotale = $montantTotale;

        return $this;
    }

    public function getFacturedAt(): ?\DateTimeInterface
    {
        return $this->facturedAt;
    }

    public function setFacturedAt(?\DateTimeInterface $facturedAt): self
    {
        $this->facturedAt = $facturedAt;

        return $this;
    }

    /**
     * @return Collection|OrdreFabrication[]
     */
    public function getOrdreFabrications(): Collection
    {
        return $this->ordreFabrications;
    }
}
