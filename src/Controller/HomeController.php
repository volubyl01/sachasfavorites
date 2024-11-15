<?php

namespace App\Controller;

use App\Repository\ElementRepository;
use App\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PokemonRepository $pokemonRepository, ElementRepository $elementRepository): Response
    {
        // $pokemons = $pokemonRepository->findAll();
        // $elements = $elementRepository->findAll();

        return $this->render('home/index.html.twig', [
            'bodyClass' => 'home',
            'controller_name' => 'HomeController',
            // 'pokemons' => $pokemons,
            // 'illustration' => $elements,
        ]);
    }
}
// A supprimer : lignes inutiles et configuration de l'index