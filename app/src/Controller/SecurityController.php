<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/reset', name: 'app_reset')]
    public function reset(Request $request, UsersRepository $usersRepository, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');

            // Rechercher l'utilisateur par e-mail
            $user = $usersRepository->findOneBy(['email' => $email]);

            if ($user) {
                // Générer un token unique
                $token = bin2hex(random_bytes(32));
                $expiration = new \DateTime('+1 hour'); // Token valide pendant 1 heure

                // Mettre à jour l'utilisateur avec le token et son expiration
                $user->setResetToken($token);
                $user->setResetTokenExpiration($expiration);
                $entityManager->persist($user);
                $entityManager->flush();

                // Générer le lien de réinitialisation
                $resetLink = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                // Envoyer l'e-mail
                $emailMessage = (new TemplatedEmail())
                    ->from('no-reply@yourdomain.com') // Remplacez par votre adresse e-mail
                    ->to($email)
                    ->subject('Réinitialisation de votre mot de passe')
                    ->htmlTemplate('emails/reset_password.html.twig')
                    ->context([
                        'resetLink' => $resetLink,
                        'user' => $user,
                        'expirationTime' => $expiration,
                    ]);

                $mailer->send($emailMessage);

                $this->addFlash('success', 'Un e-mail de réinitialisation a été envoyé à votre adresse.');
            } else {
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cet e-mail.');
            }

            return $this->redirectToRoute('app_reset');
        }

        return $this->render('security/reset.html.twig');
    }

    #[Route(path: '/reset/{token}', name: 'app_reset_password')]
    public function resetPassword(Request $request, string $token, UsersRepository $usersRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $usersRepository->findOneBy(['resetToken' => $token]);

        if (!$user || !$user->getResetTokenExpiration() || new \DateTime() > $user->getResetTokenExpiration()) {
            $this->addFlash('error', 'Le lien de réinitialisation est invalide ou a expiré.');
            return $this->redirectToRoute('app_reset');
        }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('newPassword');
            if (strlen($newPassword) >= 12 && preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]).{12,}$/', $newPassword)) {
                // Utiliser UserPasswordHasherInterface pour encoder le mot de passe
                $encodedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($encodedPassword);
                $user->setResetToken(null);
                $user->setResetTokenExpiration(null);
                $entityManager->flush();

                $this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('error', 'Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule et un caractère spécial.');
            }
        }

        return $this->render('security/reset_password.html.twig', [
            'token' => $token,
        ]);
    }
}
