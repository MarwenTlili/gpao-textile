<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColisRepository::class)
 */
class Colis
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
    private $nbrArticles;

    /**
     * @ORM\ManyToOne(targetEntity=Palette::class, inversedBy="colisList", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Palette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrArticles(): ?int
    {
        return $this->nbrArticles;
    }

    public function setNbrArticles(?int $nbrArticles): self
    {
        $this->nbrArticles = $nbrArticles;

        return $this;
    }

    public function getPalette(): ?Palette
    {
        return $this->Palette;
    }

    public function setPalette(?Palette $Palette): self
    {
        $this->Palette = $Palette;

        return $this;
    }
}
