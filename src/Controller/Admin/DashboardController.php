<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Client;
use App\Entity\Colis;
use App\Entity\Employe;
use App\Entity\Facture;
use App\Entity\Ilot;
use App\Entity\Machine;
use App\Entity\OrdreFabrication;
use App\Entity\OrdreFabricationTaille;
use App\Entity\Palette;
use App\Entity\Personnel;
use App\Entity\PlanningHebdomadaire;
use App\Entity\ProductionJournalier;
use App\Entity\Qualite;
use App\Entity\RendementJournalier;
use App\Entity\SocialLink;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GERANT');

        // return Dashboard::new()->setTitle('Issatex');
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(OrdreFabricationCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Issatex');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        // yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_index');

        // yield MenuItem::linkToCrud('Conferences', 'fas fa-map-marker-alt', Conference::class);
        // yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);

        // yield MenuItem::linkToCrud('Article', 'fas fa-article', Article::class);
        yield MenuItem::linkToCrud('Client', 'fas fa-users', Client::class);
        // yield MenuItem::linkToCrud('Company', 'fas fa-company', Company::class);
        yield MenuItem::linkToCrud('Employee', 'fas fa-users-cog', Employe::class);
        // yield MenuItem::linkToCrud('Facture', 'fas fa-facture', Facture::class);
        yield MenuItem::linkToCrud('Ilot', 'fas fa-building', Ilot::class);
        yield MenuItem::linkToCrud('Machine', 'fas fa-cogs', Machine::class);


        yield MenuItem::linkToCrud('Ordre de fabrication', 'fas fa-tasks', OrdreFabrication::class);
        // yield MenuItem::linkToRoute('Ordre de fabrication', 'fas fa-tasks', 'ordre_fabrication_index');

        yield MenuItem::linkToCrud('Colis', 'fas fa-box', Colis::class);
        yield MenuItem::linkToCrud('Palette', 'fas fa-boxes', Palette::class);
        
        // yield MenuItem::linkToCrud('Personnel', 'fas fa-personnel', Personnel::class);
        yield MenuItem::linkToCrud('Planning Hebdomadaire', 'fas fa-clock', PlanningHebdomadaire::class);
        yield MenuItem::linktoRoute('Reliquats', 'fa fa-chart-bar', 'admin_planning_hebdomadaire_reliquats');
        // yield MenuItem::linkToCrud('production', 'fas fa-planning', ProductionJournalier::class);

        // yield MenuItem::linkToCrud('Qualite', 'fas fa-qualite', Qualite::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);

        // yield MenuItem::linkToCrud('OF_Taille', 'fas fa-tasks', OrdreFabricationTaille::class);

       
    }
}
