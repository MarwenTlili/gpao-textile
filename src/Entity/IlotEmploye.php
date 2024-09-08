<?php

namespace App\Entity;

use App\Repository\IlotEmployeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IlotEmployeRepository::class)
 */
class IlotEmploye
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
    private $dateDebut;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity=Ilot::class, inversedBy="ilotEmployes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ilot;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="ilotEmployes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeImmutable $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeImmutable $dateFin): self
    {
        $this->dateFin = $dateFin;

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

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }
}
