<?php

namespace App\Entity;

use App\Config\TailleEnum;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TailleRepository::class)
 */
class Taille
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('L', 'M', 'XL')")
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=OrdreFabricationTaille::class, mappedBy="taille")
     */
    private $ordreFabricationTailles;

    public function __construct()
    {
        $this->ordreFabricationTailles = new ArrayCollection();
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
        if (!in_array($nom, array(TailleEnum::L, TailleEnum::M, TailleEnum::XL))) {
            throw new \InvalidArgumentException("Invalid status TAILLE");
        }
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|OrdreFabricationTaille[]
     */
    public function getOrdreFabricationTailles(): Collection
    {
        return $this->ordreFabricationTailles;
    }

    public function addOrdreFabricationTaille(OrdreFabricationTaille $ordreFabricationTaille): self
    {
        if (!$this->ordreFabricationTailles->contains($ordreFabricationTaille)) {
            $this->ordreFabricationTailles[] = $ordreFabricationTaille;
            $ordreFabricationTaille->setTaille($this);
        }

        return $this;
    }

    public function removeOrdreFabricationTaille(OrdreFabricationTaille $ordreFabricationTaille): self
    {
        if ($this->ordreFabricationTailles->removeElement($ordreFabricationTaille)) {
            // set the owning side to null (unless already changed)
            if ($ordreFabricationTaille->getTaille() === $this) {
                $ordreFabricationTaille->setTaille(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

}