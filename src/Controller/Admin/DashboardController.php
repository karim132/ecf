<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Locale;
use App\Repository\ReservationRepository;

use App\Entity\Ergonomie;
use App\Entity\Logiciel;
use App\Entity\Materiel;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Salle;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
    
    public function configureCrud(): Crud
    {
        return Crud::new()
            // ...
            ->overrideTemplates([
                // 'crud/index' => 'admin/pages/index.html.twig',
                'crud/field/textarea' => 'admin/fields/dynamic_textarea.html.twig',
            ])
        ;
    }

    #[Route('/admin', name: 'admin',methods :['GET','POST'])]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig');
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ReservationCrudCrudController::class)->generateUrl());
    
    }

   

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet ECF')

            -> disableDarkMode()

            ->setLocales(['en', 'fr'])

            ->setLocales([
                'en' => '🇬🇧 English',
                'fr' => '🇫🇷 French'
            ])

            ->setLocales([
                'en', 
                Locale::new('fr', 'french', 'far fa-language') 
            ])
        ;
            }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        // yield MenuItem::linkToCrud('clients', 'fas fa-list', Client::class);
        yield MenuItem::linkToCrud('users', 'fas fa-list', Users::class);
        yield MenuItem::linkToCrud('ergonomie', 'fas fa-list', Ergonomie::class);
        yield MenuItem::linkToCrud('logiciels', 'fas fa-list', Logiciel::class);
        yield MenuItem::linkToCrud('materiels', 'fas fa-list', Materiel::class);
        yield MenuItem::linkToCrud('paiements', 'fas fa-list', Paiement::class);
        yield MenuItem::linkToCrud('reservations', 'fas fa-list', Reservation::class);
        yield MenuItem::linkToCrud('salles', 'fas fa-list', Salle::class);
        
    }



}
