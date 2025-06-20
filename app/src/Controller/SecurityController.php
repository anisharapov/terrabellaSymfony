<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    #[Route('/reset', name: 'app_reset')]
    public function reset(): Response
    {
        // Logique de réinitialisation (par exemple, formulaire de demande de réinitialisation)
        return $this->render('security/reset.html.twig');
    }
}