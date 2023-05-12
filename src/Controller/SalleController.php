<?php

namespace App\Controller;

use App\Repository\Ergonomie;
use App\Repository\ErgonomieRepository;
use App\Repository\SalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalleController extends AbstractController
{
    #[Route('/salle', name: 'app_salle')]
    public function index(SalleRepository $salleRepository, ErgonomieRepository $ergonomieRepository): Response
    {  
          $salle= $salleRepository->findAll();
         
        // $ergonomie= $ergonomieRepository->findOneBySomeField();
        //  $salle= $salleRepository->findOneByIdJoinedToCategory($salle->getId) ;
        return $this->render('salle/salle.html.twig', [
          'salles'=> $salle,
          //  'ergonomie' => $ergonomie,
            // dd($salle)
       ]);
    }

        // Route qui affiche une salle en particulier
        #[Route('/salle/{id}', name: 'app_oneSalle', methods: ['GET', 'POST'])]
        public function show($id, SalleRepository $oneSalleRepository): Response
        {
           $oneSalle= $oneSalleRepository->findAllWithData();
            // Affiche la salle demandée dans le template dédié
            return $this->render('salle/oneSalle.html.twig', [
                // Récupère la salle demandée par son id
                'oneSalle' => $oneSalleRepository->findOneBy(
                    ['id' => $id],
                      // dd($oneSalle)
                ),
              ]);
}

}