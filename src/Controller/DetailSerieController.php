<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DetailSerieController extends AbstractController
{
    #[Route('/detail_serie', name: 'app_detail_serie')]
    public function index(): Response
    {
        return $this->render('detail_serie/detail_serie.html.twig', [
            'controller_name' => 'DetailSerieController',
        ]);
    }
}
