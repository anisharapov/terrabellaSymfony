<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(): Response
    {
        return $this->render('registration/index.html.twig');
    }

    #[Route('/register/submit', name: 'app_registration_submit', methods: ['POST'])]
    public function submit(): Response
    {
        // Logique de traitement du formulaire (à implémenter)
        // Exemple : redirection après succès
        return $this->redirectToRoute('app_home');
    }
}