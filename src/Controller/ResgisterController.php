<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ResgisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request$request, EntityManagerInterface $entityManager): Response
    {
        $user = new  User();
        $registerform=$this->createForm(RegisterUserTypeForm:: class, $user);
        $registerform->handleRequest($request);
        if ($registerform->isSubmitted() && $registerform->isValid()) {
            
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Votre compte a été créé avec succès, veuillez vous connecter !'
            );
             return $this->redirectToRoute(route:'app_login');
        }

        return $this->render('resgister/index.html.twig', [
            'registerform' => $registerform->createView()
        ]);
    }
}
