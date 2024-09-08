<?php

namespace App\Entity;

use App\Repository\DateProductionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DateProductionRepository::class)
 */
class DateProduction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $dateDuJour;

    /**
     * @ORM\OneToMany(targetEntity=ProductionJournalier::class, mappedBy="dateProduction", cascade={"persist", "remove"})
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

    public function getDateDuJour(): ?\DateTimeImmutable
    {
        return $this->dateDuJour;
    }

    public function setDateDuJour(\DateTimeImmutable $dateDuJour): self
    {
        $this->dateDuJour = $dateDuJour;

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
            $productionJournalier->setDateProduction($this);
        }

        return $this;
    }

    public function removeProductionJournalier(ProductionJournalier $productionJournalier): self
    {
        if ($this->productionJournalier->removeElement($productionJournalier)) {
            // set the owning side to null (unless already changed)
            if ($productionJournalier->getDateProduction() === $this) {
                $productionJournalier->setDateProduction(null);
            }
        }

        return $this;
    }
}
