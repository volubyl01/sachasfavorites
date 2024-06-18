<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DresseurController extends AbstractController
{
    #[Route('/dresseur', name: 'app_dresseur')]
    public function index(): Response
    {
        return $this->render('dresseur/index.html.twig', [
            'controller_name' => 'DresseurController',
        ]);
    }
}
