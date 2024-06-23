<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TeamService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getPagedResults(string $url, int $page = 1, int $limit = 20): array
    {
        $offset = ($page - 1) * $limit;
        $response = $this->client->request('GET', $url, [
            'query' => [
                'offset' => $offset,
                'limit' => $limit
            ]
        ]);

        $data = $response->toArray();

        // Assurez-vous que 'count' existe dans la réponse de l'API
        $totalCount = $data['count'] ?? 0;

        return [
        'results' => $data['results'],
        'count' => $totalCount,
        'currentPage' => $page,
        'totalPages' => ceil($totalCount / $limit),
        'previous' => $page > 1 ? $page - 1 : null,
        'next' => ($offset + $limit) < $totalCount ? $page + 1 : null,
        ];
    }

    public function fetchPokemons(int $offset = 0, int $limit = 20): array
    {
        $response = $this->client->request('GET', "https://pokeapi.co/api/v2/pokemon?offset={$offset}&limit={$limit}");

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erreur lors de la récupération des données de l\'API Pokémon');
        }

        return $response->toArray();
    }

    public function fetchPokemonDetails(string $url): array
    {
        $response = $this->client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erreur lors de la récupération des détails du Pokémon');
        }

        return $response->toArray();
    }
    public function getPokemonDetails(int $id): array
{
    $response = $this->client->request('GET', "https://pokeapi.co/api/v2/pokemon/{$id}");
    return $response->toArray();
}
}
