<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use GuzzleHttp\Client;
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
//     private $httpClient;

//  public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager, TeamRepository $teamRepository)
//     {
//         $this->httpClient = $httpClient;
//         // $this->entityManager = $entityManager;
//         // $this->teamRepository = $teamRepository;
//     }
public function __construct(private RequestStack $requestStack)
{
}

    #[Route('/pokemon', name: 'app_pokemon')]
    public function index(HttpClientInterface $httpClient): Response
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
        return $this->render('team/index.html.twig', [
            'pokemons' => $pokemons
        ]);
    }


    #[Route('/team/{id}', name: 'app_team_show')]
    public function showCart(int $id, TeamRepository $teamRepository): Response
    {

        $team = $teamRepository->find($id);

        if (!$team) {
            throw $this->createNotFoundException('Team not found');
        }

        return $this->render('team/index.html.twig', [
            'team' => $team,
        ]);
    }

    // #[Route('/team/add', name: 'app_team_add')]
    // public function addPokemonToTeam(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    // {
    //     $team = new Team();
    
    //     $form = $this->createForm(TeamType::class, $team);
    //     $form->handleRequest($request);
    
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($team);
    //         $entityManager->flush();
    
    //         // Stocker l'identifiant de l'équipe dans la session
    //         $session->set('team_id', $team->getId());
    
    //         return $this->redirectToRoute('app_team_show', ['id' => $team->getId()]);
    //     }
    
    //     return $this->render('team/index.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }
    
    #[Route('/team/add-pokemon', name: 'app_team_add_pokemon', methods: ['POST'])]
    public function addPokemonToTeam(Request $request, EntityManagerInterface $entityManager, TeamRepository $teamRepository, SessionInterface $session): Response
    {
        $pokemonSprite = $request->request->get('pokemon');
    
        // Récupérer l'identifiant de l'équipe depuis la session
        $id = $session->get('team_id');
        $team = $teamRepository->find($id);
    
        if (!$team) {
            throw $this->createNotFoundException('Team not found');
        }
    
        // Logique pour ajouter le pokémon à l'équipe
        $team->addPokemon($pokemonSprite);
        $entityManager->persist($team);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_team_show', ['id' => $team->getId()]);
    }
    













}
