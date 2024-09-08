<?php

namespace App\Entity;

use App\Repository\EmployePresenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployePresenceRepository::class)
 */
class EmployePresence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time_immutable")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time_immutable")
     */
    private $heureFin;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="employePresences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employe;

    /**
     * @ORM\ManyToOne(targetEntity=Presence::class, inversedBy="employePresences", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $presence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDebut(): ?\DateTimeImmutable
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeImmutable $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeImmutable
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeImmutable $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getPresence(): ?Presence
    {
        return $this->presence;
    }

    public function setPresence(?Presence $presence): self
    {
        $this->presence = $presence;

        return $this;
    }
}
