<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
class Employe
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
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRecrutement;

    /**
     * @ORM\OneToMany(targetEntity=EmployePresence::class, mappedBy="employe")
     */
    private $employePresences;

    /**
     * @ORM\OneToMany(targetEntity=IlotEmploye::class, mappedBy="employe")
     */
    private $ilotEmployes;

    public function __construct()
    {
        $this->employePresences = new ArrayCollection();
        $this->ilotEmployes = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDateRecrutement(): ?\DateTimeInterface
    {
        return $this->dateRecrutement;
    }

    public function setDateRecrutement(?\DateTimeInterface $dateRecrutement): self
    {
        $this->dateRecrutement = $dateRecrutement;

        return $this;
    }

    public function __toString()
    {
        return $this->nom.$this->prenom . " MAT".$this->matricule;
    }

    /**
     * @return Collection|EmployePresence[]
     */
    public function getEmployePresences(): Collection
    {
        return $this->employePresences;
    }

    public function addEmployePresence(EmployePresence $employePresence): self
    {
        if (!$this->employePresences->contains($employePresence)) {
            $this->employePresences[] = $employePresence;
            $employePresence->setEmploye($this);
        }

        return $this;
    }

    public function removeEmployePresence(EmployePresence $employePresence): self
    {
        if ($this->employePresences->removeElement($employePresence)) {
            // set the owning side to null (unless already changed)
            if ($employePresence->getEmploye() === $this) {
                $employePresence->setEmploye(null);
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
            $ilotEmploye->setEmploye($this);
        }

        return $this;
    }

    public function removeIlotEmploye(IlotEmploye $ilotEmploye): self
    {
        if ($this->ilotEmployes->removeElement($ilotEmploye)) {
            // set the owning side to null (unless already changed)
            if ($ilotEmploye->getEmploye() === $this) {
                $ilotEmploye->setEmploye(null);
            }
        }

        return $this;
    }
}
