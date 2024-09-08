<?php

namespace App\Controller;

use App\Entity\PlanningHebdomadaire;
use App\Repository\PlanningHebdomadaireRepository;
use App\Repository\ProductionJournalierRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/secretaire")
 */
class SecretaireController extends AbstractController
{

    public function __construct(){}

    /**
     * @Route("/secretaire", name="secretaire_index")
     */
    public function index(): Response
    {
        return $this->render('secretaire/index.html.twig', [
            'planning_hebdomadaires' => $this->planningHebdomadaireRepository->findAll(),
        ]);
    }
}
