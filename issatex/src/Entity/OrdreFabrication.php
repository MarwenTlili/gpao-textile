<?php

namespace App\Entity;

use App\Repository\OrdreFabricationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrdreFabricationRepository::class)
 */
class OrdreFabrication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteTotal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $documentTechnique;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private $tempsUnitaire;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private $prixUnitaire;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     */
    private $montant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $urgent;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $lancer;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $refuser;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="ordreFabrications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="ordreFabrications")
     */
    private $Facture;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="ordreFabrications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity=PlanningHebdomadaire::class, mappedBy="ordreFabrication")
     */
    private $planningHebdomadaires;

    /**
     * @ORM\OneToMany(targetEntity=OrdreFabricationTaille::class, mappedBy="ordreFabrication", cascade={"persist", "remove"})
     */
    private $ordreFabricationTailles;

    /**
     * @ORM\OneToMany(targetEntity=Palette::class, mappedBy="ordreFabrication", cascade={"persist", "remove"})
     */
    private $palettes;

    public function __construct()
    {
        $this->planningHebdomadaires = new ArrayCollection();
        $this->ordreFabricationTailles = new ArrayCollection();
        $this->palettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getQteTotal(): ?int
    {
        return $this->qteTotal;
    }

    public function setQteTotal(int $qteTotal): self
    {
        $this->qteTotal = $qteTotal;

        return $this;
    }

    public function getDocumentTechnique(): ?string
    {
        return $this->documentTechnique;
    }

    public function setDocumentTechnique(string $documentTechnique): self
    {
        $this->documentTechnique = $documentTechnique;

        return $this;
    }

    public function getTempsUnitaire(): ?int
    {
        return $this->tempsUnitaire;
    }

    public function setTempsUnitaire(?int $tempsUnitaire): self
    {
        $this->tempsUnitaire = $tempsUnitaire;

        return $this;
    }

    public function getPrixUnitaire(): ?string
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(?string $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(?string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getUrgent(): ?bool
    {
        return $this->urgent;
    }

    public function setUrgent(bool $urgent): self
    {
        $this->urgent = $urgent;

        return $this;
    }

    public function getLancer(): ?bool
    {
        return $this->lancer;
    }

    public function setLancer(bool $lancer): self
    {
        $this->lancer = $lancer;

        return $this;
    }

    public function getRefuser(): ?bool
    {
        return $this->refuser;
    }

    public function setRefuser(bool $refuser): self
    {
        $this->refuser = $refuser;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->Facture;
    }

    public function setFacture(?Facture $Facture): self
    {
        $this->Facture = $Facture;

        return $this;
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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
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
            $planningHebdomadaire->setOrdreFabrication($this);
        }

        return $this;
    }

    public function removePlanningHebdomadaire(PlanningHebdomadaire $planningHebdomadaire): self
    {
        if ($this->planningHebdomadaires->removeElement($planningHebdomadaire)) {
            // set the owning side to null (unless already changed)
            if ($planningHebdomadaire->getOrdreFabrication() === $this) {
                $planningHebdomadaire->setOrdreFabrication(null);
            }
        }

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
            $ordreFabricationTaille->setOrdreFabrication($this);
        }

        return $this;
    }

    public function removeOrdreFabricationTaille(OrdreFabricationTaille $ordreFabricationTaille): self
    {
        if ($this->ordreFabricationTailles->removeElement($ordreFabricationTaille)) {
            // set the owning side to null (unless already changed)
            if ($ordreFabricationTaille->getOrdreFabrication() === $this) {
                $ordreFabricationTaille->setOrdreFabrication(null);
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
            $palette->setOrdreFabrication($this);
        }

        return $this;
    }

    public function removePalette(Palette $palette): self
    {
        if ($this->palettes->removeElement($palette)) {
            // set the owning side to null (unless already changed)
            if ($palette->getOrdreFabrication() === $this) {
                $palette->setOrdreFabrication(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getArticle()->getDesignation();
    }
}
