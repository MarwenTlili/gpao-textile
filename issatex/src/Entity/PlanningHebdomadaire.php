<?php

namespace App\Entity;

use App\Repository\PlanningHebdomadaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningHebdomadaireRepository::class)
 */
class PlanningHebdomadaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $startAt;

    /**
     * @ORM\Column(type="date")
     */
    private $endAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\ManyToOne(targetEntity=Ilot::class, inversedBy="planningHebdomadaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ilot;

    /**
     * @ORM\ManyToOne(targetEntity=OrdreFabrication::class, inversedBy="planningHebdomadaires")
     * @ORM\JoinColumn(nullable=false, unique=true)
     */
    private $ordreFabrication;

    /**
     * @ORM\OneToMany(targetEntity=ProductionJournalier::class, mappedBy="planningHebdomadaire")
     */
    private $productionJournalier;

    public function __construct()
    {
        $this->productionJournalier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getIlot(): ?Ilot
    {
        return $this->ilot;
    }

    public function setIlot(?Ilot $ilot): self
    {
        $this->ilot = $ilot;

        return $this;
    }

    public function getOrdreFabrication(): ?OrdreFabrication
    {
        return $this->ordreFabrication;
    }

    public function setOrdreFabrication(?OrdreFabrication $ordreFabrication): self
    {
        $this->ordreFabrication = $ordreFabrication;

        return $this;
    }

    /**
     * @return Collection|ProductionJournalier[]
     */
    public function getProductionJournalier(): Collection
    {
        return $this->productionJournalier;
    }

    public function addProductionJournalier(ProductionJournalier $productionJournalier): self
    {
        if (!$this->productionJournalier->contains($productionJournalier)) {
            $this->productionJournalier[] = $productionJournalier;
            $productionJournalier->setPlanningHebdomadaire($this);
        }

        return $this;
    }

    public function removeProductionJournalier(ProductionJournalier $productionJournalier): self
    {
        if ($this->productionJournalier->removeElement($productionJournalier)) {
            // set the owning side to null (unless already changed)
            if ($productionJournalier->getPlanningHebdomadaire() === $this) {
                $productionJournalier->setPlanningHebdomadaire(null);
            }
        }

        return $this;
    }
}
