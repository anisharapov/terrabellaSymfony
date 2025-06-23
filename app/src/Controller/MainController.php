<?php
// src/Controller/MainController.php
namespace App\Controller;

use App\Repository\OfferingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OfferingsRepository $offeringsRepository): Response
    {
        $carouselItems = [
            ['title' => 'Welcome to Terrabella', 'image' => 'img/helmets2_converted.jpg', 'alt' => 'Motorcycle helmets'],
            ['title' => 'King size bedroom', 'image' => 'img/Room1.jpg', 'alt' => 'King size bedroom'],
            ['title' => 'Smart gym', 'image' => 'img/gym_right.jpg', 'alt' => 'Gym equipment'],
            ['title' => 'Veranda', 'image' => 'img/veranda 1.jpg', 'alt' => 'Guesthouse veranda'],
            ['title' => 'Coffee corner', 'image' => 'img/coffee spoons_converted.jpg', 'alt' => 'Coffee corner setup'],
            ['title' => 'Library', 'image' => 'img/library_converted.jpg', 'alt' => 'Library with books'],
            ['title' => 'Confortable office', 'image' => 'img/bureau table.jpg', 'alt' => 'Office desk'],
            ['title' => 'Conference room for 12 persons', 'image' => 'img/conference.jpg', 'alt' => 'Conference room'],
            ['title' => 'Tasty dinner and breakfast', 'image' => 'img/table wine.jpg', 'alt' => 'Dining table with food'],
        ];

        // Récupérer toutes les offres depuis la base de données
        $rooms = $offeringsRepository->findAll();


        return $this->render('home/index.html.twig', [
            'carousel_items' => $carouselItems,
            'rooms' => $rooms,
        ]);
    }


    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('cart/index.html.twig');
    }
}
