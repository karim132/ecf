<?php

namespace App\Controller;

use App\Repository\SalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(SalleRepository $salle): Response
    {
        return $this->render('accueil/accueil.html.twig', [

            // Récupération des 6 dernières notes
            'salles' => $salle->findBy(
              [],
              ['id' => 'ASC'],
              6
          ),
            
        ]);
    }
}

