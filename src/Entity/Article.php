<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $designation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="text")
     */
    private $composition;

    /**
     * @ORM\OneToMany(targetEntity=OrdreFabrication::class, mappedBy="article")
     */
    private $ordreFabrications;

    public function __construct()
    {
        $this->ordreFabrications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): self
    {
        $this->composition = $composition;

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
            $ordreFabrication->setArticle($this);
        }

        return $this;
    }

    public function removeOrdreFabrication(OrdreFabrication $ordreFabrication): self
    {
        if ($this->ordreFabrications->removeElement($ordreFabrication)) {
            // set the owning side to null (unless already changed)
            if ($ordreFabrication->getArticle() === $this) {
                $ordreFabrication->setArticle(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->modele;
    }
}
