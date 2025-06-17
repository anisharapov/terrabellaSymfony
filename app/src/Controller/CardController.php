<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CardController extends AbstractController
{
    #[Route('/card', name: 'app_card')]
    public function card(): Response
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }
}
