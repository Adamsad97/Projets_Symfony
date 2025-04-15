<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminUsersController extends AbstractController
{
    #[Route('/admin_users', name: 'app_admin_users')]
    public function index(): Response
    {
        return $this->render('admin_users/admin_users.html.twig', [
            'controller_name' => 'AdminUsersController',
        ]);
    }
}
