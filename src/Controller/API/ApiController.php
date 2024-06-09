<?php

namespace App\Controller\API;

use GuzzleHttp\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/api')]

class ApiController extends AbstractController
{

//ON consomme l'api et on la pérpare à stocker ses données dans la bdd interne
private $apiService;
private $entityManager;

public function __construct(ApiService $apiService, EntityManagerInterface $entityManager)
{
    $this->apiService = $apiService;
    $this->entityManager = $entityManager;
}

public function fetchAndStoreData()
{
    $data = $this->apiService->fetchApiData();

    // Traitement des données pour les stocker dans la base de données interne
    // ...

    $this->entityManager->persist($data);
    $this->entityManager->flush();

    return new Response('Données stockées avec succès');
}



    #[Route('/', name: 'app_api_index')]
    public function index()
    {
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
        

        return $this->render('api/index.html.twig', [
            'pokemons' => $pokemons
        ]);
    }
}