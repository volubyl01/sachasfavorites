<?php

namespace App\Controller\API;

use App\Service\TeamService;
use App\Entity\Team;
use GuzzleHttp\Client;
use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;


#[Route('/pokemonliste')]

class ApiController extends AbstractController
{

 #[Route('/', name: 'app_liste_index')]
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

        // on souhaite que la liste soit ordonnée alphabétiquement
        usort($pokemons, function($a, $b) {
            return strcasecmp($a['name'], $b['name']);
        });

         return $this->render('api/index.html.twig', [
            'pokemons' => $pokemons
        ]);
    }
// APi paginée
#[Route('/api/results', name: 'api_results')]
    public function getResults(Request $request, TeamService $apiService): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 20);

        $url = 'https://pokeapi.co/api/v2/pokemon/'; // Remplacez par l'URL de votre API
        $data = $apiService->getPagedResults($url, $page, $limit);

        return $this->render('api/results.html.twig', [
            'data' => $data,
        ]);
    }
// méthode pour l'import des données de l'api


#[Route('/import-pokemon', name: 'import_pokemon')]
public function importPokemon(TeamService $teamService, EntityManagerInterface $em): JsonResponse
{
    $offset = 0;
    $limit = 100; // Nombre de Pokémon à importer par lot
    $totalImported = 0;
    $totalSkipped = 0;

    do {
        $data = $teamService->fetchPokemons($offset, $limit);

        foreach ($data['results'] as $pokemonData) {
            try {
                $pokemonDetails = $teamService->fetchPokemonDetails($pokemonData['url']);
                
                // Vérifier si le Pokémon existe déjà
                $existingPokemon = $em->getRepository(Pokemon::class)->findOneBy(['name' => $pokemonDetails['name']]);
                
                if (!$existingPokemon) {
                    $pokemon = new Pokemon();
                    $pokemon->setName($pokemonDetails['name']);
                    $pokemon->setSprite($pokemonDetails['sprites']['front_default']);
                    
                    // Ajoutez d'autres propriétés si nécessaire
                    // $pokemon->setType($pokemonDetails['types'][0]['type']['name']);
                    // $pokemon->setHeight($pokemonDetails['height']);
                    // $pokemon->setWeight($pokemonDetails['weight']);
                    
                    $em->persist($pokemon);
                    $totalImported++;
                } else {
                    $totalSkipped++;
                }
            } catch (\Exception $e) {
                // Log l'erreur ou gérez-la comme vous le souhaitez
                $this->addFlash('error', 'Erreur lors de l\'importation de ' . $pokemonData['name'] . ': ' . $e->getMessage());
            }
        }

        $em->flush();
        $em->clear(); // Libère la mémoire

        $offset += $limit;
    } while ($data['next'] !== null);

    $message = sprintf(
        'Importation terminée. %d Pokémon importés, %d Pokémon ignorés (déjà existants).',
        $totalImported,
        $totalSkipped
    );

    return new JsonResponse(['message' => $message]);
}

}
