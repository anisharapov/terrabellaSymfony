<?php

namespace App\Controller;

use App\Form\RegistrationForm;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class AccountController extends AbstractController
{
    private $passwordHasher;
    private $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    #[Route('/account', name: 'app_account')]
    public function account(Request $request): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe
            $plainPassword = $form->get('plainPassword')->getData();
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Définir les dates par défaut
            if ($user->getCreatedAt() === null) {
                $user->setCreatedAt(new \DateTimeImmutable());
            }
            if ($user->getLastConnectionAt() === null) {
                $user->setLastConnectionAt(new \DateTimeImmutable());
            }

            // Persister l'utilisateur
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Registration successful! Please log in.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('account/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/client', name: 'app_client')]
    public function client(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('account/client.html.twig');
    }
}
