<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 */
class Machine
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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=IlotMachine::class, mappedBy="machine")
     */
    private $ilotMachines;

    public function __construct()
    {
        $this->ilotMachines = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
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
            $ilotMachine->setMachine($this);
        }

        return $this;
    }

    public function removeIlotMachine(IlotMachine $ilotMachine): self
    {
        if ($this->ilotMachines->removeElement($ilotMachine)) {
            // set the owning side to null (unless already changed)
            if ($ilotMachine->getMachine() === $this) {
                $ilotMachine->setMachine(null);
            }
        }

        return $this;
    }
}
