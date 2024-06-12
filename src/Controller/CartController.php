<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PokemonService;
use GuzzleHttp\Client;

class CartController extends AbstractController
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/pokemon', name: 'app_pokemon')]
    public function index(HttpClientInterface $httpClient): Response
    {
        // $response = $httpClient->request('GET', 'https://pokeapi.co/api/v2/pokemon/');
        // $pokemons = $response->toArray()['results'];

        // $content = $response->getContent();
        // $responseArray = json_decode($content, true);

        // $pokemonUrls = array_column($responseArray['results'], 'url');
        // // je crée une boucle foreach pour parcourir les urls
        // $pokemons = [];
        // foreach ($pokemonUrls as $url) {
        //     $pokemonResponse = $httpClient->request('GET', $url);
        //     $pokemonData = json_decode($pokemonResponse->response->getContent(), true);
        //     $pokemons[] = [
        //         'name' => $pokemonData['name'],
        //         'sprite' => $pokemonData['sprites']['front_default'],
        //     ];
        // }
        // return $this->render('team/index.html.twig', [
        //     'pokemons' => $pokemons,
        // ]);
       
            $client = new Client();
            $response = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/');
    
            $content = $response->getBody()->getContents();
            $responseArray = json_decode($content, true);
    // J'ai utilisé la fonction array_column() pour extraire les URLs des pokémons depuis le tableau $responseArray['results'].
    // J'ai créé une boucle foreach pour parcourir les URLs des pokémons.
    // Pour chaque URL, j'ai fait une nouvelle requête à l'API pour récupérer les données détaillées du pokémon.
    // J'ai créé un tableau associatif $pokemons contenant le nom et le sprite de chaque pokémon.
    
    // J'utilise array_column
            $pokemonUrls = array_column($responseArray['results'], 'url');
    // je crée une boucle foreach pour parcourir les urls
            $pokemons = [];
            foreach ($pokemonUrls as $url) {
                $pokemonResponse = $client->request('GET', $url);
                $pokemonData = json_decode($pokemonResponse->getBody()->getContents(), true);
                $pokemons[] = [
                    'name' => $pokemonData['name'],
                    'sprite' => $pokemonData['sprites']['front_default'],
                ];
            }
             return $this->render('team/index.html.twig', [
                'pokemons' => $pokemons
            ]);
        }
   
    #[Route('/pokemon/add', name: 'app_pokemon_add', methods: ['POST'])]

    public function addToTeam(Request $request, SessionInterface $session): Response
    {
        $pokemonUrl = $request->request->get('pokemon');
        $pokemonService = new PokemonService($this->httpClient); // Instancier le service PokemonService
        $pokemonData = $pokemonService->getPokemonData($pokemonUrl); // Utiliser la méthode getPokemonData

        $team = $session->get('team', []);
        $team[] = $pokemonData; // Ajouter les données complètes du Pokémon à la session
        $session->set('team', $team);
        return $this->redirectToRoute('app_pokemon_show');
    }
    #[Route('/pokemon/show', name: 'app_pokemon_show')]
    public function showCart(SessionInterface $session): Response
    {
        $team = $session->get('team', []);

        return $this->render('team/index.html.twig', [
            'team' => $team,
        
        ]);
    }
}
