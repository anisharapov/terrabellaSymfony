<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(Request $request): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesForm::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Logique pour sauvegarder la catégorie (e.g., avec Doctrine)
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Category saved successfully!');
            return $this->redirectToRoute('app_categories');
        }

        return $this->render('categories/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}