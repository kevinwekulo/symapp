<?php

namespace App\Controller;

use App\Entity\Passenger;
use App\Form\PassengerForm;
use App\Repository\PassengerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PassengerController extends AbstractController
{
    #[Route('/passenger', name: 'app_passenger')]
    public function index(PassengerRepository $passengerRepository): Response
    {
        // Logic to handle the request and display the passenger list
        $passengers = $passengerRepository->findAll();
    

        return $this->render('passenger/index.html.twig', [
            'passengers' => $passengers,
        ]);
    }

    #[Route('/passenger/new', name: 'app_passenger_new')]
    public function new(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Logic to handle the request and create a new passenger
        $passenger = new Passenger();
        $form = $this->createForm(PassengerForm::class, $passenger);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($passenger);
            $entityManagerInterface->flush();

            // Redirect to a success page or show a success message
            return $this->redirectToRoute('app_passenger');
        }
        // Logic to create a new passenger
        return $this->render('passenger/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
