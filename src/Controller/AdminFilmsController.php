<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminFilmsController extends AbstractController
{
    #[Route('/admin_films', name: 'app_admin_films')]
    public function index(): Response
    {
        return $this->render('admin_films/admin_films.html.twig', [
            'controller_name' => 'AdminFilmsController',
        ]);
    }
}
