<?php

namespace App\Controller;

use App\Entity\Palette;
use App\Form\PaletteType;
use App\Repository\PaletteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/palette")
 */
class PaletteController extends AbstractController
{
    /**
     * @Route("/", name="palette_index", methods={"GET"})
     */
    public function index(PaletteRepository $paletteRepository): Response
    {
        return $this->render('palette/index.html.twig', [
            'palettes' => $paletteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="palette_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $palette = new Palette();
        $form = $this->createForm(PaletteType::class, $palette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($palette);
            $entityManager->flush();

            return $this->redirectToRoute('palette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('palette/new.html.twig', [
            'palette' => $palette,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="palette_show", methods={"GET"})
     */
    public function show(Palette $palette): Response
    {
        return $this->render('palette/show.html.twig', [
            'palette' => $palette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="palette_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Palette $palette, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaletteType::class, $palette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('palette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('palette/edit.html.twig', [
            'palette' => $palette,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="palette_delete", methods={"POST"})
     */
    public function delete(Request $request, Palette $palette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$palette->getId(), $request->request->get('_token'))) {
            $entityManager->remove($palette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('palette_index', [], Response::HTTP_SEE_OTHER);
    }
}
