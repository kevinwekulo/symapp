<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientForm;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
    public function index(ClientRepository $clientRepository): Response
    {
        // Fetch all clients from the database
        $clients = $clientRepository->findAll();

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/client/new', name: 'app_client_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $client = new Client();
        $form = $this->createForm(ClientForm::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('success', 'Client created successfully!');
            // Redirect to the client list or any other page           

            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
