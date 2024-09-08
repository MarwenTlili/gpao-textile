<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valider;

    /**
     * @ORM\Column(type="boolean")
     */
    private $privilegier;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="client", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=OrdreFabrication::class, mappedBy="client")
     */
    private $ordreFabrications;

    /**
     * @ORM\OneToMany(targetEntity=Palette::class, mappedBy="client")
     */
    private $palettes;

    public function __construct()
    {
        $this->planningHebdomadaires = new ArrayCollection();
        $this->ordreFabrications = new ArrayCollection();
        $this->palettes = new ArrayCollection();
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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getValider(): ?bool
    {
        return $this->valider;
    }

    public function setValider(bool $valider): self
    {
        $this->valider = $valider;

        return $this;
    }

    public function getPrivilegier(): ?bool
    {
        return $this->privilegier;
    }

    public function setPrivilegier(bool $privilegier): self
    {
        $this->privilegier = $privilegier;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|OrdreFabrication[]
     */
    public function getOrdreFabrications(): Collection
    {
        return $this->ordreFabrications;
    }

    public function addOrdreFabrication(OrdreFabrication $ordreFabrication): self
    {
        if (!$this->ordreFabrications->contains($ordreFabrication)) {
            $this->ordreFabrications[] = $ordreFabrication;
            $ordreFabrication->setClient($this);
        }

        return $this;
    }

    public function removeOrdreFabrication(OrdreFabrication $ordreFabrication): self
    {
        if ($this->ordreFabrications->removeElement($ordreFabrication)) {
            // set the owning side to null (unless already changed)
            if ($ordreFabrication->getClient() === $this) {
                $ordreFabrication->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Palette[]
     */
    public function getPalettes(): Collection
    {
        return $this->palettes;
    }

    public function addPalette(Palette $palette): self
    {
        if (!$this->palettes->contains($palette)) {
            $this->palettes[] = $palette;
            $palette->setClient($this);
        }

        return $this;
    }

    public function removePalette(Palette $palette): self
    {
        if ($this->palettes->removeElement($palette)) {
            // set the owning side to null (unless already changed)
            if ($palette->getClient() === $this) {
                $palette->setClient(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

}
