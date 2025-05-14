<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketForm;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class TicketController extends AbstractController
{
    #[Route('/ticket', name: 'app_ticket')]
    public function index(TicketRepository $ticketRepository): Response
    {
        // Logic to handle the request and display the ticket list
        $tickets = $ticketRepository->findAll();

        return $this->render('ticket/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    #[Route('/ticket/new', name: 'app_ticket_new')]
    public function new(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Logic to handle the request and create a new ticket
        $tickets = new Ticket();
        $form = $this->createForm(TicketForm::class, $tickets);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($tickets);
            $entityManagerInterface->flush();

            // Redirect to a success page or show a success message
            return $this->redirectToRoute('app_ticket');
        }
        // This is just a placeholder, you would typically use a form to create a new ticket
        return $this->render('ticket/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
