<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\PasswordUserTypeForm;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity;
use FFI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    //route la page de modification du mot de passe
     #[Route('/compte/modifier-mon-mot-de-passe', name: 'app_account_modify_password')]
    public function password(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        
        $user=$this->getUser();
        $form = $this->createForm(PasswordUserTypeForm::class, $user, [
            'passwordHasher' => $passwordHasher,
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Votre mot de passe est correctement mis à jour !'
            );
        }
        return $this->render('account/password.html.twig', [
            'modifypwd' => $form->createView(),
        ]);
    }
}
