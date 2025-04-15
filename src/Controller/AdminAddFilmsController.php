<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminAddFilmsController extends AbstractController
{
    #[Route('/admin_add_films', name: 'app_admin_add_films')]
    public function index(): Response
    {
        return $this->render('admin_add_films/admin_add_films.html.twig', [
            'controller_name' => 'AdminAddFilmsController',
        ]);
    }
}
