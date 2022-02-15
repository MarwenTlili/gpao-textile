<?php

namespace App\Controller;

use App\Entity\EmployePresence;
use App\Entity\Presence;
use App\Form\EmployePresenceType;
use App\Repository\EmployePresenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employe-presence")
 */
class EmployePresenceController extends AbstractController
{
    /**
     * @Route("/", name="employe_presence_index", methods={"GET"})
     */
    public function index(EmployePresenceRepository $employePresenceRepository): Response
    {
        return $this->render('employe_presence/index.html.twig', [
            'employe_presences' => $employePresenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="employe_presence_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $presence = new Presence();
        $presence->setDateJour(new \DateTimeImmutable('now'));

        $employePresence = new EmployePresence();
        $form = $this->createForm(EmployePresenceType::class, $employePresence);
        $form->handleRequest($request);
        $employePresence->setPresence($presence);
        $employePresence->setHeureDebut(new \DateTimeImmutable('now'));
        $employePresence->setHeureFin(new \DateTimeImmutable('now'));

        dump($employePresence);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($employePresence->getHeureDebut());
            $entityManager->persist($employePresence);
            $entityManager->flush();

            return $this->redirectToRoute('employe_presence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employe_presence/new.html.twig', [
            'employe_presence' => $employePresence,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="employe_presence_show", methods={"GET"})
     */
    public function show(EmployePresence $employePresence): Response
    {
        dump($employePresence);
        return $this->render('employe_presence/show.html.twig', [
            'employe_presence' => $employePresence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="employe_presence_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EmployePresence $employePresence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmployePresenceType::class, $employePresence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('employe_presence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employe_presence/edit.html.twig', [
            'employe_presence' => $employePresence,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="employe_presence_delete", methods={"POST"})
     */
    public function delete(Request $request, EmployePresence $employePresence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employePresence->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employePresence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employe_presence_index', [], Response::HTTP_SEE_OTHER);
    }
}
