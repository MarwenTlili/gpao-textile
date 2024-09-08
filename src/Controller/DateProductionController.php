<?php

namespace App\Controller;

use App\Entity\DateProduction;
use App\Form\DateProductionType;
use App\Repository\DateProductionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/date-production")
 */
class DateProductionController extends AbstractController
{
    /**
     * @Route("/", name="date_production_index", methods={"GET"})
     */
    public function index(DateProductionRepository $dateProductionRepository): Response
    {
        return $this->render('date_production/index.html.twig', [
            'date_productions' => $dateProductionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="date_production_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dateProduction = new DateProduction();
        $form = $this->createForm(DateProductionType::class, $dateProduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dateProduction);
            $entityManager->flush();

            return $this->redirectToRoute('date_production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('date_production/new.html.twig', [
            'date_production' => $dateProduction,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="date_production_show", methods={"GET"})
     */
    public function show(DateProduction $dateProduction): Response
    {
        return $this->render('date_production/show.html.twig', [
            'date_production' => $dateProduction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="date_production_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DateProduction $dateProduction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DateProductionType::class, $dateProduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('date_production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('date_production/edit.html.twig', [
            'date_production' => $dateProduction,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="date_production_delete", methods={"POST"})
     */
    public function delete(Request $request, DateProduction $dateProduction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dateProduction->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dateProduction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('date_production_index', [], Response::HTTP_SEE_OTHER);
    }
}
