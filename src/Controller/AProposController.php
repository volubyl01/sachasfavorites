<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class AProposController extends AbstractController
{

    private $backgroundImages = [
        'apropos' => '1329.jpg',
    ];

    #[Route('/apropos', name: 'app_a_propos')]
    public function index(): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();
        return $this->render('a_propos/index.html.twig', [
            'bodyClass' => 'neutrals',
            'username_dresseur' => $user ? $user->getUserIdentifier() : 'Visiteur',
           'backgroundImage' => $this->backgroundImages['apropos']

        ]);
    }
}
