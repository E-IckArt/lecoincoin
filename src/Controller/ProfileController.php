<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Placer la route '/profil' avant la classe permet d'utiliser toutes les méthodes de la classe sur cette route
#[Route('/profil', name: 'app_profile_')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Profil de l\'utilisateur',
        ]);
    }

    #[Route('/commandes', name: 'orders')]
    public function orders(): Response
    {
        return $this->render('profile/orders.html.twig', [
            'controller_name' => 'Commandes de l\'utilisateur',
        ]);
    }
}

