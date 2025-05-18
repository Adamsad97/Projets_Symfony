<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commentaire;

final class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'app_commentaire')]
public function index(EntityManagerInterface $em): Response
{
    $commentaires = $em->getRepository(Commentaire::class)->findAll();

    return $this->render('commentaire/index.html.twig', [
        'commentaires' => $commentaires,
    ]);
}
}
