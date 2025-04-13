<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
    #[Route('/connexion', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        //Gestion des erreurs
        $error = $authenticationUtils->getLastAuthenticationError();

        //Dernier email saisi par user pour l'éviter à rétaper son email après chaque erreur de mot de passe

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            // On passe les 2 variables à notre fichier twig
            'error' => $error,
            'last_username' => $lastUsername,

        ]);
    }
    #[Route('/deconnexion', 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        throw new \Exception('Do\t forget to activate the logout in security.yaml');
    }
}
