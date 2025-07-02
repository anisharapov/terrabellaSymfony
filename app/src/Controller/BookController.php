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
        // Mapper les propriétés de l'entité Offerings dans un tableau
        $offeringData = [
            'id' => $offering->getId(),
            'price' => $offering->getPrice() ?? 0.0, // Valeur par défaut si null
            'name' => $offering->getName() ?? 'Offre inconnue', // Valeur par défaut si null
        ];

        return $this->render('book/index.html.twig', [
            'offering' => $offeringData, // Passer le tableau mappé
        ]);
    }
}