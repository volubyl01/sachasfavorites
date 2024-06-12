<?php 
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;


// Le service PokemonService utilise l'injection de dépendances pour recevoir une instance de HttpClientInterface dans son constructeur. Cela permet au service d'effectuer des requêtes HTTP sans avoir à instancier directement le client HTTP.
// La méthode getAllPokemons() récupère uniquement les données de base des Pokémons (nom et URL). Pour obtenir les données détaillées d'un Pokémon, y compris l'URL du sprite, vous devez utiliser la méthode getPokemonData().
// La méthode getPokemonData() vérifie si la clé sprites existe dans la réponse de l'API, et si la clé front_default existe dans sprites. Si c'est le cas, elle extrait l'URL du sprite et l'inclut dans le tableau de données retourné.
// Les deux méthodes retournent des tableaux associatifs contenant les données des Pokémons. Vous pouvez utiliser ces données dans vos contrôleurs et les transmettre à vos templates Twig pour les afficher.

class PokemonService
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getAllPokemons(): array
    {
        $response = $this->httpClient->request('GET', 'https://pokeapi.co/api/v2/pokemon/');
        $pokemons = $response->toArray()['results'];

        return $pokemons;
    }
// l'URL du sprite est stockée dans la clé sprites.front_default de la réponse de l'API,
public function getPokemonData(string $pokemonUrl): array
{
    $response = $this->httpClient->request('GET', $pokemonUrl);
    $pokemonData = $response->toArray();

    // Vérifier si la clé 'sprites' existe dans la réponse
    $sprite = null;
    if (isset($pokemonData['sprite']) && isset($pokemonData['sprite']['front_default'])) {
        // Extraire l'URL de l'image du sprite
        $sprite = $pokemonData['sprite']['front_default'];
    }

    return [
        'name' => $pokemonData['name'],
        'url' => $pokemonUrl,
        'sprite' => $sprite,
    ];

    
}
}
