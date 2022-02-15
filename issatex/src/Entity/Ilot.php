<?php

namespace App\Entity;

use App\Repository\IlotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IlotRepository::class)
 */
class Ilot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=PlanningHebdomadaire::class, mappedBy="ilot")
     */
    private $planningHebdomadaires;

    /**
     * @ORM\OneToMany(targetEntity=IlotMachine::class, mappedBy="ilot")
     */
    private $ilotMachines;

    /**
     * @ORM\OneToMany(targetEntity=IlotEmploye::class, mappedBy="ilot")
     */
    private $ilotEmployes;

    /**
     * @ORM\OneToMany(targetEntity=ProductionJournalier::class, mappedBy="ilot")
     */
    private $productionJournalier;

    public function __construct()
    {
        $this->planningHebdomadaires = new ArrayCollection();
        $this->ilotMachines = new ArrayCollection();
        $this->ilotEmployes = new ArrayCollection();
        $this->productionJournalier = new ArrayCollection();
    }

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

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * @return Collection|PlanningHebdomadaire[]
     */
    public function getPlanningHebdomadaires(): Collection
    {
        return $this->planningHebdomadaires;
    }

    public function addPlanningHebdomadaire(PlanningHebdomadaire $planningHebdomadaire): self
    {
        if (!$this->planningHebdomadaires->contains($planningHebdomadaire)) {
            $this->planningHebdomadaires[] = $planningHebdomadaire;
            $planningHebdomadaire->setIlot($this);
        }

        return $this;
    }

    public function removePlanningHebdomadaire(PlanningHebdomadaire $planningHebdomadaire): self
    {
        if ($this->planningHebdomadaires->removeElement($planningHebdomadaire)) {
            // set the owning side to null (unless already changed)
            if ($planningHebdomadaire->getIlot() === $this) {
                $planningHebdomadaire->setIlot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IlotMachine[]
     */
    public function getIlotMachines(): Collection
    {
        return $this->ilotMachines;
    }

    public function addIlotMachine(IlotMachine $ilotMachine): self
    {
        if (!$this->ilotMachines->contains($ilotMachine)) {
            $this->ilotMachines[] = $ilotMachine;
            $ilotMachine->setIlot($this);
        }

        return $this;
    }

    public function removeIlotMachine(IlotMachine $ilotMachine): self
    {
        if ($this->ilotMachines->removeElement($ilotMachine)) {
            // set the owning side to null (unless already changed)
            if ($ilotMachine->getIlot() === $this) {
                $ilotMachine->setIlot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IlotEmploye[]
     */
    public function getIlotEmployes(): Collection
    {
        return $this->ilotEmployes;
    }

    public function addIlotEmploye(IlotEmploye $ilotEmploye): self
    {
        if (!$this->ilotEmployes->contains($ilotEmploye)) {
            $this->ilotEmployes[] = $ilotEmploye;
            $ilotEmploye->setIlot($this);
        }

        return $this;
    }

    public function removeIlotEmploye(IlotEmploye $ilotEmploye): self
    {
        if ($this->ilotEmployes->removeElement($ilotEmploye)) {
            // set the owning side to null (unless already changed)
            if ($ilotEmploye->getIlot() === $this) {
                $ilotEmploye->setIlot(null);
            }
        }

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
            $productionJournalier->setIlot($this);
        }

        return $this;
    }

    public function removeProductionJournalier(ProductionJournalier $productionJournalier): self
    {
        if ($this->productionJournalier->removeElement($productionJournalier)) {
            // set the owning side to null (unless already changed)
            if ($productionJournalier->getIlot() === $this) {
                $productionJournalier->setIlot(null);
            }
        }

        return $this;
    }
}
