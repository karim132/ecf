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
use App\Entity\Users;


class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation', methods: ['GET', 'POST'])]
    public function index(SalleRepository $salleResa , $id): Response
    {
      
        return $this->render('reservation/reservation.html.twig', [
           // Récupère la note demandée par son id
            'reservation' => $salleResa->findOneBy(
              ['id' => $id],
            
            ),
         ]);
    }
    #[Route('/reservation/{id}', name: 'app_reservation', methods: ['GET', 'POST'])]
    public function NewResa(Users $users,Request $request,EntityManagerInterface $entityManager, UsersRepository $usersRepository): Response
    {

        // $users = $usersRepository->find(1);
        // $resa->setUser($users);
        $resa = new Reservation();
        $form = $this->createForm(ReservationType::class, $resa);
        $form->handleRequest($request);
          $users->getUser();
        //  $resa->setUser($users);
        dd($resa);
        if ($form->isSubmitted() && $form->isValid()){
          
          $entityManager->persist($resa);
          $entityManager->flush();
          //  $users = $usersRepository->find();
          //  $resa->setUser($users);
    }
        return $this->render('reservation/reservation.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
