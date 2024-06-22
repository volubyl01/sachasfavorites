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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    #[Route('/pokemon', name: 'app_pokemon')]
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
            $entityManager->persist($team);
            $entityManager->flush();

            $session->set('team_id', $team->getId());

            $this->addFlash('success', 'Équipe créée avec succès.');
            return $this->redirectToRoute('app_team_show', ['id' => $team->getId()]);
        }

        return $this->render('team/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route("/add-to-team/{id}", name: "add_to_team", methods: ["GET"])]
    public function addToTeam(int $id, Request $request, TeamService $teamService, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $sprite = $request->query->get('sprite');
    
        // Récupérer l'ID de l'équipe depuis la session
        $teamId = $session->get('team_id');
        
        // Vérifier si une équipe existe
        if (!$teamId) {
            $this->addFlash('error', 'Aucune équipe sélectionnée. Veuillez d\'abord créer une équipe.');
            return $this->redirectToRoute('app_team_add');
        }
        
        // Récupérer l'équipe existante
        $team = $entityManager->getRepository(Team::class)->find($teamId);
        
        if (!$team) {
            $this->addFlash('error', 'Équipe non trouvée.');
            return $this->redirectToRoute('app_team_add');
        }
        
        // Construire l'URL complète du Pokémon
        $url = "https://pokeapi.co/api/v2/pokemon/{$id}/";
        
        // Récupérer les détails du Pokémon depuis l'API
        $pokemonDetails = $teamService->fetchPokemonDetails($url);
        
        // Vérifier si l'équipe a déjà 6 Pokémons
        if (count($team->getPokemons()) >= 6) {
            $this->addFlash('error', 'L\'équipe est déjà complète (6 Pokémons maximum).');
            return $this->redirectToRoute('app_pokemon');
        }
        
        // Créer un nouvel objet Pokemon et l'ajouter à l'équipe
        $pokemon = new Pokemon();
        $pokemon->setName($pokemonDetails['name']);
        $pokemon->setApiId($pokemonDetails['id']);
        $pokemon->setSprite($sprite); // Utilisez le sprite passé en paramètre
        $pokemon->setDescription($pokemonDetails['description'] ?? ''); 
        $pokemon->setLevel($pokemonDetails['level'] ?? '1'); 
        $pokemon->setTeam($team); // N'oubliez pas d'associer le Pokémon à l'équipe
    
        $team->addPokemon($pokemon); // Ajoutez le Pokémon à l'équipe
        $pokemon->setTeam($team);
    
        $entityManager->persist($pokemon);
        $entityManager->flush();
        
        $this->addFlash('success', $pokemonDetails['name'] . ' a été ajouté à votre équipe !');
        
        return $this->redirectToRoute('app_pokemon');
    }
    
}
