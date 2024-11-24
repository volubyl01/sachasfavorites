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

class TeamController extends AbstractController
{

    private $backgroundImages = [
        'team' => 'images/backgrounds/pokeball-pokemon-pngrepo-com.webp',
        'show' => 'images/backgrounds/pokeball-pokemon-pngrepo-com.webp',
        'add' => 'images/backgrounds/pokeball-pokemon-pngrepo-com.webp',
        'index' => 'images/backgrounds/pokeball-pokemon-pngrepo-com.webp'
    ];

    public function __construct(private RequestStack $requestStack) {}

    #[Route('/team/create', name: 'app_team_index')]
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
            'backgroundImage' => $this->backgroundImages['index']
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
            'backgroundImage' => $this->backgroundImages['index']
        ]);
    }

    #[Route("/team/add-to-team/{id}", name: "add_to_team", methods: ["POST"])]
    public function addToTeam(
        int $id,
        Request $request,
        TeamService $teamService,
        EntityManagerInterface $entityManager,
        SessionInterface $session
    ): Response {
        try {
            // Vérification de l'équipe
            $teamId = $session->get('team_id');
            if (!$teamId) {
                throw new \Exception('Aucune équipe sélectionnée. Veuillez d\'abord créer une équipe.');
            }

            $team = $entityManager->getRepository(Team::class)->find($teamId);
            if (!$team) {
                throw new \Exception('Équipe non trouvée.');
            }

            if (count($team->getPokemons()) >= 6) {
                throw new \Exception('L\'équipe est déjà complète (6 Pokémons maximum).');
            }

            // Récupération des données Pokémon
            $sprite = $request->request->get('sprite');
            $url = "https://pokeapi.co/api/v2/pokemon/{$id}/";
            $pokemonDetails = $teamService->fetchPokemonDetails($url);

            // Gestion de l'image
            $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/pokemon/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = uniqid() . '.png';
            $imageContent = file_get_contents($sprite);
            if ($imageContent === false) {
                throw new \Exception('Impossible de télécharger l\'image.');
            }

            file_put_contents($uploadDir . $fileName, $imageContent);

            // Création du Pokémon
            $pokemon = new Pokemon();
            $pokemon->setName($pokemonDetails['name'])
                ->setApiId($pokemonDetails['id'])
                ->setSprite($sprite)
                ->setImage('uploads/pokemon/' . $fileName)
                ->setDescription($pokemonDetails['description'] ?? '')
                ->setLevel($pokemonDetails['level'] ?? 1)
                ->setTeam($team);

            $team->addPokemon($pokemon);

            // Persistance des données
            $entityManager->persist($pokemon);
            $entityManager->flush();

            $this->addFlash('success', $pokemonDetails['name'] . ' a été ajouté à votre équipe !');
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_team_add');
        }

        return $this->redirectToRoute('app_team_index');
    }
}
