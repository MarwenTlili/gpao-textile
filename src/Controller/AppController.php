<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        if ($this->isGranted('ROLE_CLIENT')) {
            return $this->redirectToRoute('client_index');
        }elseif ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin');
        }elseif ($this->isGranted('ROLE_SECRETAIRE')){
            return $this->redirectToRoute('planning_hebdomadaire_index');
        }

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/redirect", name="app_redirect")
     */
    public function home(): Response
    {        
        return $this->render('app/index.html.twig', []);
    }
}
