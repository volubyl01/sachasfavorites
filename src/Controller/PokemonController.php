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
    private $entityManager;
    private $pokemonRepository;
    private $elementRepository;
    private $teamRepository;
    private $security;
    private $httpClient;
    private $imagineCacheManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        PokemonRepository $pokemonRepository,
        ElementRepository $elementRepository,
        TeamRepository $teamRepository,
        Security $security,
        HttpClientInterface $httpClient,
        CacheManager $imagineCacheManager
    ) {
        $this->entityManager = $entityManager;
        $this->pokemonRepository = $pokemonRepository;
        $this->elementRepository = $elementRepository;
        $this->teamRepository = $teamRepository;
        $this->security = $security;
        $this->httpClient = $httpClient;
        $this->imagineCacheManager = $imagineCacheManager;
    }

    // pour éviter l'erreur 404 et améliorer gestion des routes
    #[Route('/', name: 'app_pokemon_redirect')]
    public function redirectToIndex(): Response
    {
        return $this->redirectToRoute('app_pokemon_index');
    }

    #[Route('/pokemon', name: 'app_pokemon_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchingType::class, null, ['method' => 'GET']);
        $form->handleRequest($request);

        $pokemons = $this->pokemonRepository->findAll();
        $elements = $this->elementRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $searchName = $form->get('name')->getData();
            $searchSpecificite = $form->get('specificite')->getData();

            if (!empty($searchName)) {
                $pokemons = $this->pokemonRepository->searchByName($searchName);
            } elseif (!empty($searchSpecificite)) {
                $pokemons = $this->pokemonRepository->searchBySpecificite($searchSpecificite);
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

    #[Route('/new', name: 'app_pokemon_new', methods: ['GET', 'POST'])]
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
            return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pokemon/new.html.twig', [
            'bodyClass' => 'new-pokemon',
            'pokemon' => $pokemon,
            'form' => $form->createView(),
        ]);
    }





    #[Route('/add-to-team/{id}', name: 'add_to_team', methods: ['POST'])]
    public function addToTeam(int $id): Response
    {
        $team = $this->teamRepository->findOneBy(['dresseur' => $this->getUser()]);

        if ($team && $team->getPokemons()->count() >= 6) {
            $this->addFlash('error', 'Votre équipe est déjà complète (maximum 6 Pokémon)');
            return $this->redirectToRoute('app_pokemon_index');
        }
    }


    #[Route('/{id}/edit', name: 'app_pokemon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pokemon $pokemon): Response
    {
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handlePokemonForm($pokemon, $form);
            $this->entityManager->flush();

            $this->addFlash('success', 'Le Pokémon a été mis à jour avec succès.');
            return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
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

    #[Route('/{id}/delete', name: 'app_pokemon_delete', methods: ['POST'])]
    public function delete(Request $request, Pokemon $pokemon): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pokemon->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($pokemon);
            $this->entityManager->flush();
            $this->addFlash('success', 'Le Pokémon a été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}', name: 'app_pokemon_show', methods: ['GET'], requirements: ['id' => '\d+'])]
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
        
        $oldImage = $pokemon->getImage();
        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/Image/';

        if ($oldImage && file_exists($uploadDir . $oldImage)) {
            unlink($uploadDir . $oldImage);
            $this->imagineCacheManager->remove($oldImage);
        }

        $imageName = uniqid() . '.' . $image->guessExtension();
        $image->move($uploadDir, $imageName);
        $pokemon->setImage($imageName);

        // Génère les versions redimensionnées
        $this->imagineCacheManager->getBrowserPath($imageName, 'thumbnail');
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
