<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Publication;
use Doctrine\ORM\EntityManagerInterface;

final class PublicationController extends AbstractController
{
    #[Route('/publication', name: 'app_publication')]
public function index(EntityManagerInterface $em): Response
{
    $publications = $em->getRepository(Publication::class)->findAll();

    return $this->render('publication/index.html.twig', [
        'publications' => $publications,
    ]);
    }
}