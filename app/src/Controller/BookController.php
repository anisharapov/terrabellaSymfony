<?php

namespace App\Controller;

use App\Entity\Offerings;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    #[Route('/book/{id}', name: 'app_book', requirements: ['id' => '\d+'])]
    public function book(Offerings $offering): Response
    {

        return $this->render('book/index.html.twig', [
            'offering' => $offering, // Passer les données mappées
        ]);
    }
}
