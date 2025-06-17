<?php
// src/Controller/MainController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $carouselItems = [
            ['title' => 'Welcome to Terrabella', 'image' => 'img/helmets2_converted.jpg', 'alt' => 'Motorcycle helmets'],
            ['title' => 'King size bedroom', 'image' => 'img/Room 1.jpg', 'alt' => 'King size bedroom'],
            ['title' => 'Smart gym', 'image' => 'img/gym left.jpg', 'alt' => 'Gym equipment'],
        ];

        $rooms = [
            [
                'title' => 'KING SIZE ROOM',
                'description' => 'Book a king size room 2,20 meter large with a Orthopedic Mattress',
                'image' => 'img/Room 1.jpg',
                'alt' => 'King size bedroom',
                'prices' => ['From 99$ per night'],
                'link_route' => 'app_book_room',
                'button_text' => 'CHECK THE AVAILABILITY',
            ],
            [
                'title' => 'CONFERENCE ROOM',
                'description' => 'Our elegant conference room, equipped with modern audiovisual technology, is perfect for professional meetings and events. It offers a comfortable, versatile space accommodating up to 12 guests',
                'image' => 'img/conference table_converted.jpg',
                'alt' => 'Conference room',
                'prices' => ['From 149$ per session'],
                'link_route' => 'app_book_conference',
                'button_text' => 'MAKE A RESERVATION',
            ],
            [
                'title' => 'SMART GYM',
                'description' => 'Our state-of-the-art gym features top-quality fitness equipment for all levels, ensuring an invigorating workout experience. Open daily, it provides a spacious and motivating environment for your wellness needs',
                'image' => 'img/gym right.jpg',
                'alt' => 'Smart gym',
                'prices' => ['39$ per month', 'Included for the guests'],
                'link_route' => 'app_book_gym',
                'button_text' => 'Buy a subscription',
            ],
        ];

        return $this->render('home/index.html.twig', [
            'carousel_items' => $carouselItems,
            'rooms' => $rooms,
        ]);
    }

    #[Route('/rooms', name: 'app_rooms')]
    public function rooms(): Response
    {
        $room = [
            'title' => 'KING SIZE ROOM',
            'description' => 'Book a king size room 2,20 meter large with a Orthopedic Mattress',
            'image' => 'img/Room 1.jpg',
            'alt' => 'King size bedroom',
            'prices' => ['From 99$ per night'],
            'link_route' => 'app_book_room',
            'button_text' => 'CHECK THE AVAILABILITY',
        ];
        return $this->render('rooms/index.html.twig', [
            'room' => $room,
        ]);
    }

    #[Route('/conference', name: 'app_conference')]
    public function conference(): Response
    {
        $room = [
            'title' => 'CONFERENCE ROOM',
            'description' => 'Our elegant conference room, equipped with modern audiovisual technology, is perfect for professional meetings and events. It offers a comfortable, versatile space accommodating up to 12 guests',
            'image' => 'img/conference table_converted.jpg',
            'alt' => 'Conference room',
            'prices' => ['From 149$ per session'],
            'link_route' => 'app_book_conference',
            'button_text' => 'MAKE A RESERVATION',
        ];
        return $this->render('conference/index.html.twig', [
            'room' => $room,
        ]);
    }

    #[Route('/gym', name: 'app_gym')]
    public function gym(): Response
    {
        $room = [
            'title' => 'SMART GYM',
            'description' => 'Our state-of-the-art gym features top-quality fitness equipment for all levels, ensuring an invigorating workout experience. Open daily, it provides a spacious and motivating environment for your wellness needs',
            'image' => 'img/gym right.jpg',
            'alt' => 'Smart gym',
            'prices' => ['39$ per month', 'Included for the guests'],
            'link_route' => 'app_book_gym',
            'button_text' => 'Buy a subscription',
        ];
        return $this->render('gym/index.html.twig', [
            'room' => $room,
        ]);
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        // Logique pour la page du panier (à implémenter)
        return $this->render('cart/index.html.twig');
    }
}