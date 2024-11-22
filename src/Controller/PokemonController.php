<?php

namespace App\Controller;

use App\Entity\{Team, Element, Pokemon};
use App\Form\{PokemonType, SearchingType};
use App\Repository\{TeamRepository, ElementRepository, PokemonRepository};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Form\Form;


#[Route('/monpokemon')]
class PokemonController extends AbstractController
{

    private const MAX_TEAM_SIZE = 6;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly PokemonRepository $pokemonRepository,
        private readonly ElementRepository $elementRepository,
        private readonly TeamRepository $teamRepository,
        private readonly Security $security,
        private readonly HttpClientInterface $httpClient,
        private readonly CacheManager $imagineCacheManager
    ) {}

    #[Route('/pokemon', name: 'monpokemon_pokemon_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchingType::class, null, ['method' => 'GET']);
        $form->handleRequest($request);

        $pokemons = $this->pokemonRepository->findAll();
        $elements = $this->elementRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $searchByName = $form->get('name')->getData();
            $searchBySpecificite = $form->get('specificite')->getData();

            if (!empty($searchByName)) {
                $pokemons = $this->pokemonRepository->searchByName($searchByName);
            } elseif (!empty($searchBySpecificite)) {
                $pokemons = $this->pokemonRepository->searchBySpecificite($searchBySpecificite);
            }
        }

        usort($pokemons, fn($a, $b) => strcasecmp($a->getName(), $b->getName()));

        return $this->render('pokemon/index.html.twig', [
            'form' => $form->createView(),
            'pokemons' => $pokemons,
            'elements' => $elements,
            'bodyClass' => 'liste-pokemons',
        ]);
    }
    #[Route('/new', name: 'monpokemon_pokemon_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $pokemon = new Pokemon();
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handlePokemonForm($pokemon, $form);
            $this->entityManager->persist($pokemon);
            $this->entityManager->flush();

            $this->addFlash('success', 'Le Pokémon a été créé avec succès.');
            return $this->redirectToRoute('monpokemon_pokemon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pokemon/new.html.twig', [
            'bodyClass' => 'new-pokemon',
            'pokemon' => $pokemon,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/add-to-team/{id}', name: 'monpokemon_pokemon_add_to_team', methods: ['POST'])]
    public function addToTeam(int $id): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('Vous devez être connecté.');
        }

        $pokemon = $this->pokemonRepository->find($id);
        if (!$pokemon) {
            try {
                $response = $this->httpClient->request('GET', "https://pokeapi.co/api/v2/pokemon/{$id}");
                $pokemonData = $response->toArray();

                $pokemon = new Pokemon();
                $pokemon->setName($pokemonData['name']);
                $pokemon->setSprite($pokemonData['sprites']['front_default']);
                $this->entityManager->persist($pokemon);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors de la récupération du Pokémon.');
                return $this->redirectToRoute('monpokemon_pokemon_index');
            }
        }

        $team = $this->teamRepository->findOneBy(['dresseur' => $user]) ?? new Team();
        if (!$team->getId()) {
            $team->setDresseur($user);
        }

        if ($team->getPokemons()->count() >= self::MAX_TEAM_SIZE) {
            $this->addFlash('error', 'Équipe complète (max 6 Pokémon)');
            return $this->redirectToRoute('monpokemon_pokemon_index');
        }

        if (!$team->getPokemons()->contains($pokemon)) {
            $team->addPokemon($pokemon);
            $this->entityManager->persist($team);
            $this->entityManager->flush();
            $this->addFlash('success', $pokemon->getName() . ' ajouté à l\'équipe');
        } else {
            $this->addFlash('error', $pokemon->getName() . ' est déjà dans l\'équipe');
        }

        return $this->redirectToRoute('monpokemon_pokemon_index');
    }
    #[Route('/{id}/edit', name: 'monpokemon_pokemon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pokemon $pokemon): Response
    {
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handlePokemonForm($pokemon, $form);
            $this->entityManager->flush();

            $this->addFlash('success', 'Le Pokémon a été mis à jour avec succès.');
            return $this->redirectToRoute('monpokemon_pokemon_index', [], Response::HTTP_SEE_OTHER);
        }

        $element = $pokemon->getElement();
        $illustration = $element ? $element->getIllustration() : null;

        return $this->render('pokemon/edit.html.twig', [
            'pokemon' => $pokemon,
            'illustration' => $illustration,
            'element' => $element,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/{id}/delete', name: 'monpokemon_pokemon_delete', methods: ['POST'])]
    public function delete(Request $request, Pokemon $pokemon): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pokemon->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($pokemon);
            $this->entityManager->flush();
            $this->addFlash('success', 'Le Pokémon a été supprimé avec succès.');
        }

        return $this->redirectToRoute('monpokemon_pokemon_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}', name: 'monpokemon_pokemon_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Pokemon $pokemon): Response
    {
        $element = $pokemon->getElement();
        $illustration = $element ? $element->getIllustration() : null;

        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
            'illustration' => $illustration,
        ]);
    }


    private function handleImageUpload(Pokemon $pokemon, UploadedFile $image): void
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image->getMimeType(), $allowedMimeTypes)) {
            throw new \InvalidArgumentException('Format d\'image non supporté');
        }

        $uploadDir = $this->getParameter('upload_directory');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $oldImage = $pokemon->getImage();
        if ($oldImage && file_exists($uploadDir . $oldImage)) {
            unlink($uploadDir . $oldImage);
            $this->imagineCacheManager->remove($oldImage);
        }

        try {
            $imageName = uniqid() . '.' . $image->guessExtension();
            $image->move($uploadDir, $imageName);
            $pokemon->setImage($imageName);
            $this->imagineCacheManager->getBrowserPath($imageName, 'thumbnail');
        } catch (\Exception $e) {
            throw new \RuntimeException('Erreur lors du téléchargement de l\'image');
        }
    }




    private function handlePokemonForm(Pokemon $pokemon, Form $form): void
    {
        $element = $form->get('element')->getData();
        if ($element !== null) {
            $pokemon->setElement($element);
        }

        $image = $form->get('image')->getData();
        if ($image instanceof UploadedFile) {
            $this->handleImageUpload($pokemon, $image);
        }
    }
}
