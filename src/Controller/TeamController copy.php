<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Entity\Pokemon;
use App\Service\TeamService;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class TeamController extends AbstractController
{
    private array $backgroundImages;

    public function __construct(private RequestStack $requestStack)
    {
        $this->backgroundImages = [
            'team' => 'AdobeStock_585885970.webp',
            'show' => 'AdobeStock_585885970.webp',
            'add' => 'AdobeStock_585885970.webp',
            'index' => 'AdobeStock_585885970.webp',
        ];
    }

    #[Route('/team', name: 'app_team_index')]
    public function index(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://pokeapi.co/api/v2/pokemon/');

        $content = $response->getContent();
        $responseArray = json_decode($content, true);

        $pokemonUrls = array_column($responseArray['results'], 'url');
        $pokemons = [];
        foreach ($pokemonUrls as $url) {
            $pokemonResponse = $httpClient->request('GET', $url);
            $pokemonData = json_decode($pokemonResponse->getContent(), true);
            $pokemons[] = [
                'name' => $pokemonData['name'],
                'sprite' => $pokemonData['sprites']['front_default'],
                'id' => basename(rtrim($url, '/')), // Extraire l'ID de l'URL
            ];
        }

        usort($pokemons, function ($a, $b) {
            return strcasecmp($a['name'], $b['name']);
        });

        return $this->render('team/index.html.twig', [
            'pokemons' => $pokemons,
            'backgroundImage' => $this->backgroundImages['index']
        ]);
    }

    #[Route('/team/{id}', name: 'app_team_show')]
    public function showTeam(int $id, TeamRepository $teamRepository): Response
    {
        $team = $teamRepository->find($id);

        if (!$team) {
            throw $this->createNotFoundException('Team not found');
        }

        return $this->render('team/show.html.twig', [
            'team' => $team,
            'backgroundImage' => $this->backgroundImages['show']
        ]);
    }

    #[Route('/team/add', name: 'app_team_add')]
    public function addTeam(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour créer une équipe.');
            return $this->redirectToRoute('app_login');
        }

        $team = new Team();
        $team->setDresseur($user);

        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($team);
                $entityManager->flush();

                $session->set('team_id', $team->getId());

                $this->addFlash('success', 'Équipe créée avec succès.');
                return $this->redirectToRoute('app_team_show', ['id' => $team->getId()]);
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('error', 'Ce nom d\'équipe est déjà utilisé. Veuillez en choisir un autre.');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la création de l\'équipe.');
            }
        }

        return $this->render('team/add.html.twig', [
            'form' => $form->createView(),
            'backgroundImage' => $this->backgroundImages['add']
        ]);
    }

    #[Route("/add-to-team/{id}", name: "add_to_team", methods: ["POST"])]
    #[IsGranted('ROLE_USER')]
    public function addToTeam(int $id, Request $request, TeamService $teamService, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $sprite = $request->request->get('sprite');

        $teamId = $session->get('team_id');

        if (!$teamId) {
            $this->addFlash('error', 'Aucune équipe sélectionnée. Veuillez d\'abord créer une équipe.');
            return $this->redirectToRoute('app_team_add');
        }

        $team = $entityManager->getRepository(Team::class)->find($teamId);

        if (!$team) {
            $this->addFlash('error', 'Équipe non trouvée.');
            return $this->redirectToRoute('app_team_add');
        }

        $url = "https://pokeapi.co/api/v2/pokemon/{$id}/";
        $pokemonDetails = $teamService->fetchPokemonDetails($url);

        if (count($team->getPokemons()) >= 6) {
            $this->addFlash('error', 'L\'équipe est déjà complète (6 Pokémons maximum).');
            return $this->redirectToRoute('monpokemon_pokemon_index');
        }

        $pokemon = new Pokemon();
        $pokemon->setName($pokemonDetails['name']);
        $pokemon->setApiId($pokemonDetails['id']);
        $pokemon->setSprite($sprite);
        $pokemon->setDescription($pokemonDetails['description'] ?? '');
        $pokemon->setLevel($pokemonDetails['level'] ?? 1);

        // Établir la relation bidirectionnelle
        $pokemon->setTeam($team);
        $team->addPokemon($pokemon);

        $entityManager->persist($pokemon);
        $entityManager->persist($team);
        $entityManager->flush();

        $this->addFlash('success', $pokemonDetails['name'] . ' a été ajouté à votre équipe !');

        return $this->redirectToRoute('monpokemon_pokemon_index');
    }
}
