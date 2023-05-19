<?php

namespace App\Controller;

use App\Form\ReservationType;
use App\Repository\UsersRepository;
use App\Repository\SalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reservation;
use App\Entity\Salle;
use App\Entity\Users;
use App\Controller\ReservationController\etSalle;


class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation', methods: ['GET', 'POST'])]
    public function index(SalleRepository $salleResa ,$id): Response
    {
      
        return $this->render('reservation/reservation.html.twig', [
           // Récupère la salle demandée par son id
            'reservation' => $salleResa->findOneBy(
              ['id' => $id],
            
            ),
         ]);
    }
    #[Route('/reservation/{id}', name: 'app_reservation', methods: ['GET', 'POST'])]
    
    public function NewResa(Request $request,EntityManagerInterface $entityManager,Users $user,Salle $salle): Response
    {

    
        $resa = new Reservation();
        $form = $this->createForm(ReservationType::class, $resa);
        $user = $this->getUser();
        
        

        $form->handleRequest($request);
       
        
        
        if ($form->isSubmitted() && $form->isValid()){

          $resa->setUser($user);
          $resa->setSalle($salle);
          $entityManager->persist($resa);
          $entityManager->flush();

          
    }  return $this->render('reservation/reservation.html.twig',[
            
              'form' => $form->createView(),
      
           
        ]);
      }


}