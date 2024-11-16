<?php

namespace App\Controller\API;


use GuzzleHttp\Client;
use App\Entity\Pokemon;
use App\Service\TeamService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/pokemonliste')]
class ApiController extends AbstractController
{
    // #[Route('/', name: 'app_liste_index')]
    // public function index()
    // {
    //     $client = new Client();
    //     $response = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/');

    //     $content = $response->getBody()->getContents();
    //     $responseArray = json_decode($content, true);
    //     // J'utilise array_column() pour extraire les URLs des pokémons depuis le tableau $responseArray['results'].
    //     $pokemonUrls = array_column($responseArray['results'], 'url');
    //     // je crée une boucle foreach pour parcourir les urls
    //     // Pour chaque URL, j'ai fait une nouvelle requête à l'API pour récupérer les données détaillées du pokémon.
    //     // J'ai créé un tableau associatif $pokemons contenant le nom et le sprite de chaque pokémon.
    //     $pokemons = [];
    //     foreach ($pokemonUrls as $url) {
    //         $pokemonResponse = $client->request('GET', $url);
    //         $pokemonData = json_decode($pokemonResponse->getBody()->getContents(), true);
    //         $pokemons[] = [
    //             'name' => $pokemonData['name'],
    //             'sprite' => $pokemonData['sprites']['front_default'],
    //         ];
    //     }
    //     // on souhaite que la liste soit ordonnée alphabétiquement
    //     usort($pokemons, function ($a, $b) {
    //         return strcasecmp($a['name'], $b['name']);
    //     });

    //     return $this->render('api/results.html.twig', [
    //         'pokemons' => $pokemons
    //     ]);
    // }
    // APi paginée
    #[Route('/results', name: 'app_api_results')]
    public function getResults(Request $request, HttpClientInterface $httpClient): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 15; // Nombre de  pages

        $offset = ($page - 1) * $limit;
        $url = "https://pokeapi.co/api/v2/pokemon?offset={$offset}&limit={$limit}";

        $response = $httpClient->request('GET', $url);
        $data = $response->toArray();

        $totalCount = $data['count'];
        $totalPages = ceil($totalCount / $limit);

        $results = array_map(function ($pokemon) use ($httpClient) {
            $detailResponse = $httpClient->request('GET', $pokemon['url']);
            $detail = $detailResponse->toArray();
            return [
                'id' => $detail['id'],
                'name' => $detail['name'],
                'sprite' => $detail['sprites']['front_default'],
            ];
        }, $data['results']);

        // Sort the results by name
        usort($results, function ($a, $b) {
            return strcasecmp($a['name'], $b['name']);
        });

        return $this->render('pokemon/combined_view.html.twig', [
            'data' => [
                'results' => $results,
                'count' => $totalCount,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'previous' => $page > 1 ? $page - 1 : null,
                'next' => $page < $totalPages ? $page + 1 : null,
            ],
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
                } catch (UniqueConstraintViolationException $e) {
                    // Log l'erreur ou gérez-la comme vous le souhaitez
                    $this->addFlash('error', 'Le Pokémon ' . $pokemonDetails['name'] . ' existe déjà dans Sacha\'s Favorites.');
                    $totalSkipped++;
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


    // #[Route('/add-to-team/{id}', name: 'add_to_team')]
    // public function addToTeam(int $id, TeamService $teamService, EntityManagerInterface $entityManager): Response
    // {
    //     // Récupérer les détails du Pokémon depuis l'API
    //     $url = "https://pokeapi.co/api/v2/pokemon/{$id}/";
    //     $pokemonDetails = $teamService->fetchPokemonDetails($url);

    //     // Vérifier si le Pokémon existe déjà dans la base de données
    //     $existingPokemon = $entityManager->getRepository(Pokemon::class)->findOneBy(['name' => $pokemonDetails['name']]);

    //     if (!$existingPokemon) {
    //         // Créer un nouvel objet Pokemon et l'ajouter à la base de données
    //         $pokemon = new Pokemon();
    //         $pokemon->setName($pokemonDetails['name']);
    //         $pokemon->setSprite($pokemonDetails['sprites']['front_default']);
    //         $pokemon->setDescription($pokemonDetails['description']);
    //         $pokemon->setLevel($pokemonDetails['level']);
    //         $pokemon->setImage($pokemonDetails['image']);

    //         $entityManager->persist($pokemon);
    //         $entityManager->flush();

    //         $this->addFlash('success', $pokemonDetails['name'] . ' a été ajouté à votre équipe !');
    //     } else {
    //         $this->addFlash('error', $pokemonDetails['name'] . ' est déjà dans votre équipe.');
    //     }

    //     return $this->redirectToRoute('api_results');
    // }


}
