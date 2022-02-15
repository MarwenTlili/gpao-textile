<?php

namespace App\Controller;

use App\Entity\OrdreFabricationTaille;
use App\Form\OrdreFabricationTailleType;
use App\Repository\OrdreFabricationTailleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ordre/fabrication/taille")
 */
class OrdreFabricationTailleController extends AbstractController
{
    /**
     * @Route("/", name="ordre_fabrication_taille_index", methods={"GET"})
     */
    public function index(OrdreFabricationTailleRepository $ordreFabricationTailleRepository): Response
    {
        return $this->render('ordre_fabrication_taille/index.html.twig', [
            'ordre_fabrication_tailles' => $ordreFabricationTailleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ordre_fabrication_taille_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ordreFabricationTaille = new OrdreFabricationTaille();
        $form = $this->createForm(OrdreFabricationTailleType::class, $ordreFabricationTaille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ordreFabricationTaille);
            $entityManager->flush();

            return $this->redirectToRoute('ordre_fabrication_taille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ordre_fabrication_taille/new.html.twig', [
            'ordre_fabrication_taille' => $ordreFabricationTaille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_fabrication_taille_show", methods={"GET"})
     */
    public function show(OrdreFabricationTaille $ordreFabricationTaille): Response
    {
        return $this->render('ordre_fabrication_taille/show.html.twig', [
            'ordre_fabrication_taille' => $ordreFabricationTaille,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ordre_fabrication_taille_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, OrdreFabricationTaille $ordreFabricationTaille, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrdreFabricationTailleType::class, $ordreFabricationTaille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ordre_fabrication_taille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ordre_fabrication_taille/edit.html.twig', [
            'ordre_fabrication_taille' => $ordreFabricationTaille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_fabrication_taille_delete", methods={"POST"})
     */
    public function delete(Request $request, OrdreFabricationTaille $ordreFabricationTaille, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordreFabricationTaille->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ordreFabricationTaille);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ordre_fabrication_taille_index', [], Response::HTTP_SEE_OTHER);
    }
}
