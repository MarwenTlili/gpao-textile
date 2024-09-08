<?php

namespace App\Controller;

use App\Entity\DateProduction;
use App\Entity\PlanningHebdomadaire;
use App\Form\PlanningHebdomadaireType;
use App\Repository\PlanningHebdomadaireRepository;
use App\Repository\ProductionJournalierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planning-hebdomadaire")
 */
class PlanningHebdomadaireController extends AbstractController
{
    private $pourcentageReliquat = 5;

    /**
     * @Route("/", name="planning_hebdomadaire_index", methods={"GET"})
     */
    public function index(PlanningHebdomadaireRepository $planningHebdomadaireRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETAIRE', null,'Access Denied.');

        return $this->render('planning_hebdomadaire/index.html.twig', [
            'planning_hebdomadaires' => $planningHebdomadaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="planning_hebdomadaire_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null,'Access Denied.');
        $planningHebdomadaire = new PlanningHebdomadaire();
        $form = $this->createForm(PlanningHebdomadaireType::class, $planningHebdomadaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planningHebdomadaire);
            $entityManager->flush();

            return $this->redirectToRoute('planning_hebdomadaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planning_hebdomadaire/new.html.twig', [
            'planning_hebdomadaire' => $planningHebdomadaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="planning_hebdomadaire_show", methods={"GET"})
     */
    public function show(PlanningHebdomadaire $planningHebdomadaire): Response
    {
        dump($planningHebdomadaire);
        $this->denyAccessUnlessGranted('ROLE_SECRETAIRE', null,'Access Denied.');

        return $this->render('planning_hebdomadaire/show.html.twig', [
            'planning_hebdomadaire' => $planningHebdomadaire,
        ]);
        
    }

    /**
     * @Route("/reliquats/list", name="planning_hebdomadaire_reliquats")
     */
    public function reliquats(PlanningHebdomadaireRepository $planningHebdomadaireRepository): Response
    {   $reliquats = new ArrayCollection();
        $toutLesPlanning = $planningHebdomadaireRepository->findAll();

        foreach ($toutLesPlanning as $key => $planning) {
            $aProduire = $planning->getOrdreFabrication()->getQteTotal();
            $somme = 0;
            $rest = 0;
            foreach ($planning->getProductionJournalier() as $key => $productionJournalier) {
                $somme += $productionJournalier->getQuantitePremiereChoix()+$productionJournalier->getQuantiteDeuxiemeChoix();
            }

            $rest = $aProduire - $somme;
            $seuil = round(($somme * $this->pourcentageReliquat) / 100);
            dump("aProduire: {$aProduire};produit: {$somme}; rest: {$rest}; seil: {$seuil}");

            if ( ($rest > $seuil) && ($planning->getEndAt() < new \DateTime('now')) ) {
                $reliquats[] = $planning;
            }
        }

        return $this->render('planning_hebdomadaire/reliquats.html.twig', [
            'plannings_hebdomadaire' => $reliquats
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planning_hebdomadaire_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PlanningHebdomadaire $planningHebdomadaire, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETAIRE', null,'Access Denied.');

        $form = $this->createForm(PlanningHebdomadaireType::class, $planningHebdomadaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('planning_hebdomadaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planning_hebdomadaire/edit.html.twig', [
            'planning_hebdomadaire' => $planningHebdomadaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="planning_hebdomadaire_delete", methods={"POST"})
     */
    public function delete(Request $request, PlanningHebdomadaire $planningHebdomadaire, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETAIRE', null,'Access Denied.');

        if ($this->isCsrfTokenValid('delete'.$planningHebdomadaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($planningHebdomadaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_hebdomadaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
