<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Validator\Constraints\Collection;


// Le service TeamService utilise l'injection de dépendances pour recevoir une instance de HttpClientInterface dans son constructeur. Cela permet au service d'effectuer des requêtes HTTP sans avoir à instancier directement le client HTTP.
// La méthode getAllPokemons() récupère uniquement les données de base des Pokémons (nom et URL). Pour obtenir les données détaillées d'un Pokémon, y compris l'URL du sprite, vous devez utiliser la méthode getPokemonData().
// La méthode getPokemonData() vérifie si la clé sprites existe dans la réponse de l'API, et si la clé front_default existe dans sprites. Si c'est le cas, elle extrait l'URL du sprite et l'inclut dans le tableau de données retourné.
// Les deux méthodes retournent des tableaux associatifs contenant les données des Pokémons. Vous pouvez utiliser ces données dans vos contrôleurs et les transmettre à vos templates Twig pour les afficher.

class TeamService
{
    private $httpClient;

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

        // Vérifier si la requête a réussi
        if ($response->getStatusCode() === 200) {
            $pokemonData = $response->toArray();

            // Vérifier si la clé 'sprites' existe dans la réponse
            // $sprite = null;
            if (isset($pokemonData['sprites']) && isset($pokemonData['sprites']['front_default'])) {
                // Extraire l'URL de l'image du sprite
                $sprite = $pokemonData['sprites']['front_default'];
            }

            return [
                'name' => $pokemonData['name'],
                'sprite' => $sprite,
                // Vous pouvez ajouter d'autres données du Pokémon ici si nécessaire
            ];
        } else {
            // Gérer l'erreur de requête
            throw new \Exception('Erreur lors de la récupération des données du Pokémon');
        }
    }
    private $pokemons = [];

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->pokemons = new ArrayCollection();
    }

    public function addPokemonToTeam(string $pokemonSprite): self
    {
        if (!in_array($pokemonSprite, $this->pokemons->toArray())) {
            $this->pokemons[] = $pokemonSprite;
        }
        return $this;
    }

    public function getPokemons()
    {
        return $this->pokemons;
    }
}
