<?php

namespace App\Controller;

use App\Entity\DateProduction;
use App\Entity\PlanningHebdomadaire;
use App\Entity\ProductionJournalier;
use App\Form\ProductionJournalierType;
use App\Repository\ProductionJournalierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/production-journalier")
 */
class ProductionJournalierController extends AbstractController
{
    /**
     * @Route("/", name="production_journalier_index", methods={"GET"})
     */
    public function index(ProductionJournalierRepository $productionJournalierRepository): Response
    {
        return $this->render('production_journalier/index.html.twig', [
            'production_journaliers' => $productionJournalierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{planningHebdomadaire}", name="production_journalier_new", methods={"GET", "POST"})
     */
    public function new(Request $request,PlanningHebdomadaire $planningHebdomadaire, EntityManagerInterface $entityManager): Response
    {
        // dump($planningHebdomadaire);
        $dateProduction = new DateProduction();
        $dateProduction->setDateDuJour(new \DateTimeImmutable('now'));
        $entityManager->persist($dateProduction);

        $productionJournalier = new ProductionJournalier();
        $productionJournalier->setDateProduction($dateProduction);
        $productionJournalier->setIlot($planningHebdomadaire->getIlot());

        $form = $this->createForm(ProductionJournalierType::class, $productionJournalier);
        $form->handleRequest($request);

        dump($form);
        dump($productionJournalier);

        $productionJournalier->setPlanningHebdomadaire($planningHebdomadaire);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productionJournalier);
            $entityManager->flush();

            return $this->redirectToRoute('planning_hebdomadaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_journalier/new.html.twig', [
            'production_journalier' => $productionJournalier,
            'planningHebdomadaire' => $planningHebdomadaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="production_journalier_show", methods={"GET"})
     */
    public function show(ProductionJournalier $productionJournalier): Response
    {
        return $this->render('production_journalier/show.html.twig', [
            'production_journalier' => $productionJournalier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="production_journalier_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProductionJournalier $productionJournalier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductionJournalierType::class, $productionJournalier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('production_journalier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_journalier/edit.html.twig', [
            'production_journalier' => $productionJournalier,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="production_journalier_delete", methods={"POST"})
     */
    public function delete(Request $request, ProductionJournalier $productionJournalier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productionJournalier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($productionJournalier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('production_journalier_index', [], Response::HTTP_SEE_OTHER);
    }
}
