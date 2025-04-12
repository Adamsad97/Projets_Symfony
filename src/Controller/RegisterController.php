<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User(); //Création d'un nouvel objet user qui correspond à mon entité
        $form = $this->createForm(RegisterUserType::class, $user);

        $form->handleRequest($request); //Ecoute la request que l'utilisateur soumet dans le formulaire

        if($form->isSubmitted() && $form->isValid()){
         // dd($form->getData());
            //dd($user);
          $entityManager->persist($user); //pour figer les données
          $entityManager->flush(); //pour rengistrer les données
        }
        //Si le formulaire est soumis:
        //Tu enrégistres les datas en Base de données
        //Tu envoies un message de confirmation du compte bien créé

        return $this->render('register/index.html.twig',[
            'registerForm' => $form->createView()
        ]);
    }
}
