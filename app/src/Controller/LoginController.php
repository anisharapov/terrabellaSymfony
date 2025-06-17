<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('login/index.html.twig');
    }

    #[Route('/login/submit', name: 'app_login_submit', methods: ['POST'])]
    public function submit(): Response
    {
        // Logique de traitement du formulaire (à implémenter)
        // Exemple : authentification et redirection après succès
        return $this->redirectToRoute('app_home');
    }
}