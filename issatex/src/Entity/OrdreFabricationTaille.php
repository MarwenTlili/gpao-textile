<?php

namespace App\Entity;

use App\Repository\OrdreFabricationTailleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdreFabricationTailleRepository::class)
 */
class OrdreFabricationTaille
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=OrdreFabrication::class, inversedBy="ordreFabricationTailles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordreFabrication;

    /**
     * @ORM\ManyToOne(targetEntity=Taille::class, inversedBy="ordreFabricationTailles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $taille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

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

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function __toString()
    {
        return serialize($this);
    }
}
