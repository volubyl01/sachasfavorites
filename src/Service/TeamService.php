<?php  
// src/Service/PokemonApiService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TeamService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    // APi paginée
    public function getPagedResults(string $url, int $page = 1, int $limit = 20): array
    {
        $response = $this->client->request('GET', $url, [
            'query' => [
                'offset' => ($page - 1) * $limit,
                'limit' => $limit
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erreur lors de la récupération des données de l\'API');
        }

        $data = $response->toArray();

        return [
            'results' => $data['results'],
            'count' => $data['count'],
            'next' => $data['next'],
            'previous' => $data['previous'],
            'currentPage' => $page,
            'totalPages' => ceil($data['count'] / $limit)
        ];
    }
// Fonction Fetch
    public function fetchPokemons(int $limit = 20): array
    {
        $response = $this->client->request('GET', "https://pokeapi.co/api/v2/pokemon?limit={$limit}");

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erreur lors de la récupération des données de l\'API Pokémon');
        }

        return $response->toArray()['results'];
    }

    public function fetchPokemonDetails(string $url): array
    {
        $response = $this->client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erreur lors de la récupération des détails du Pokémon');
        }

        return $response->toArray();
    }
}
