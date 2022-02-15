<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresenceRepository::class)
 */
class Presence
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
    private $dateJour;

    /**
     * @ORM\OneToMany(targetEntity=EmployePresence::class, mappedBy="presence")
     */
    private $employePresences;

    public function __construct()
    {
        $this->employePresences = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateJour(): ?\DateTimeImmutable
    {
        return $this->dateJour;
    }

    public function setDateJour(\DateTimeImmutable $dateJour): self
    {
        $this->dateJour = $dateJour;

        return $this;
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
            $employePresence->setPresence($this);
        }

        return $this;
    }

    public function removeEmployePresence(EmployePresence $employePresence): self
    {
        if ($this->employePresences->removeElement($employePresence)) {
            // set the owning side to null (unless already changed)
            if ($employePresence->getPresence() === $this) {
                $employePresence->setPresence(null);
            }
        }

        return $this;
    }
}
