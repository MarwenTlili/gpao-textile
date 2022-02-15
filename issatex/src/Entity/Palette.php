<?php

namespace App\Entity;

use App\Repository\PaletteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaletteRepository::class)
 */
class Palette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qteTotaleArticles;

    /**
     * @ORM\OneToMany(targetEntity=Colis::class, mappedBy="Palette", cascade={"persist", "remove"})
     */
    private $colisList;

    /**
     * @ORM\ManyToOne(targetEntity=OrdreFabrication::class, inversedBy="palettes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordreFabrication;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="palettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function __construct()
    {
        $this->colisList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteTotaleArticles(): ?int
    {
        return $this->qteTotaleArticles;
    }

    public function setQteTotaleArticles(?int $qteTotaleArticles): self
    {
        $this->qteTotaleArticles = $qteTotaleArticles;

        return $this;
    }

    /**
     * @return Collection|Colis[]
     */
    public function getColisList(): Collection
    {
        return $this->colisList;
    }

    public function addColisList(Colis $colisList): self
    {
        if (!$this->colisList->contains($colisList)) {
            $this->colisList[] = $colisList;
            $colisList->setPalette($this);
        }

        return $this;
    }

    public function removeColisList(Colis $colisList): self
    {
        if ($this->colisList->removeElement($colisList)) {
            // set the owning side to null (unless already changed)
            if ($colisList->getPalette() === $this) {
                $colisList->setPalette(null);
            }
        }

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

    public function __toString()
    {
        return "PAL-$this->id";
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
