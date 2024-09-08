<?php

namespace App\Controller;

use App\Entity\Ilot;
use App\Form\IlotType;
use App\Repository\IlotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ilot")
 */
class IlotController extends AbstractController
{
    /**
     * @Route("/", name="ilot_index", methods={"GET"})
     */
    public function index(IlotRepository $ilotRepository): Response
    {
        return $this->render('ilot/index.html.twig', [
            'ilots' => $ilotRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ilot_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ilot = new Ilot();
        $form = $this->createForm(IlotType::class, $ilot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ilot);
            $entityManager->flush();

            return $this->redirectToRoute('ilot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ilot/new.html.twig', [
            'ilot' => $ilot,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ilot_show", methods={"GET"})
     */
    public function show(Ilot $ilot): Response
    {
        return $this->render('ilot/show.html.twig', [
            'ilot' => $ilot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ilot_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ilot $ilot, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IlotType::class, $ilot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ilot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ilot/edit.html.twig', [
            'ilot' => $ilot,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ilot_delete", methods={"POST"})
     */
    public function delete(Request $request, Ilot $ilot, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ilot->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ilot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ilot_index', [], Response::HTTP_SEE_OTHER);
    }
}
