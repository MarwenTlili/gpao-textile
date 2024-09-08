<?php

namespace App\Entity;

use App\Repository\ProductionJournalierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ProductionJournalierRepository::class)
 */
class ProductionJournalier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private $quantitePremiereChoix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private $quantiteDeuxiemeChoix;

    /**
     * @ORM\ManyToOne(targetEntity=DateProduction::class, inversedBy="productionJournalier", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dateProduction;

    /**
     * @ORM\ManyToOne(targetEntity=Ilot::class, inversedBy="productionJournalier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ilot;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningHebdomadaire::class, inversedBy="productionJournalier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planningHebdomadaire;

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantitePremiereChoix(): ?int
    {
        return $this->quantitePremiereChoix;
    }

    public function setQuantitePremiereChoix(int $quantitePremiereChoix): self
    {
        $this->quantitePremiereChoix = $quantitePremiereChoix;

        return $this;
    }

    public function getQuantiteDeuxiemeChoix(): ?int
    {
        return $this->quantiteDeuxiemeChoix;
    }

    public function setQuantiteDeuxiemeChoix(int $quantiteDeuxiemeChoix): self
    {
        $this->quantiteDeuxiemeChoix = $quantiteDeuxiemeChoix;

        return $this;
    }

    public function getDateProduction(): ?DateProduction
    {
        return $this->dateProduction;
    }

    public function setDateProduction(?DateProduction $dateProduction): self
    {
        $this->dateProduction = $dateProduction;

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

    public function getPlanningHebdomadaire(): ?PlanningHebdomadaire
    {
        return $this->planningHebdomadaire;
    }

    public function setPlanningHebdomadaire(?PlanningHebdomadaire $planningHebdomadaire): self
    {
        $this->planningHebdomadaire = $planningHebdomadaire;

        return $this;
    }
}
