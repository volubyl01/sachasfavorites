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


    private $backgroundImages = [
        'index' => 'images/backgrounds/pokemmo-pngrepo-com.webp',
        'new' => 'images/backgrounds/pokemmo-pngrepo-com.webp',
        'edit' => 'images/backgrounds/pokemmo-pngrepo-com.webp',
        'show' => 'images/backgrounds/pokemmo-pngrepo-com.webp',
    ];



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
            'backgroundImage' => $this->backgroundImages['index'] // Image pour la page d'index
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
            'backgroundImage' => $this->backgroundImages['new'] // Image pour la page d'index
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
            'backgroundImage' => $this->backgroundImages['edit'] 
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
            'backgroundImage' => $this->backgroundImages['show'] 
        ]);
    }


    private function handleImageUpload(Pokemon $pokemon, UploadedFile $image): void
    {
        // 1. Validation du type MIME
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
        if (!in_array($image->getMimeType(), $allowedMimeTypes)) {
            throw new \InvalidArgumentException(
                'Format d\'image non supporté. Formats acceptés : JPEG, PNG, GIF, WEBP'
            );
        }
    
        // 2. Vérification et création du répertoire
        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/images/pokemon/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new \RuntimeException('Impossible de créer le répertoire d\'upload');
            }
        }
    
        // 3. Suppression de l'ancienne image
        $oldImage = $pokemon->getImage();
        if ($oldImage) {
            $oldImagePath = $uploadDir . $oldImage;
            if (file_exists($oldImagePath)) {
                try {
                    unlink($oldImagePath);
                    $this->imagineCacheManager->remove($oldImage);
                } catch (\Exception $e) {
                    throw new \RuntimeException('Erreur lors de la suppression de l\'ancienne image : ' . $e->getMessage());
                }
            }
        }
    
        // 4. Upload de la nouvelle image
        try {
            $imageName = uniqid() . '_' . time() . '.' . $image->guessExtension();
            $image->move($uploadDir, $imageName);
            $pokemon->setImage($imageName);
            
            // 5. Génération du thumbnail
            try {
                $this->imagineCacheManager->getBrowserPath($imageName, 'thumbnail');
            } catch (\Exception $e) {
                throw new \RuntimeException('Erreur lors de la génération du thumbnail : ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            throw new \RuntimeException(
                'Erreur lors du téléchargement de l\'image : ' . $e->getMessage()
            );
        }
    }
    

    private function handleElementImageUpload(Element $element, UploadedFile $illustration): void
{
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
    if (!in_array($illustration->getMimeType(), $allowedMimeTypes)) {
        throw new \InvalidArgumentException('Format d\'image non supporté');
    }

    $uploadDir = $this->getParameter('upload_directory');
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $oldIllustration = $element->getIllustration();
    if ($oldIllustration && file_exists($uploadDir . $oldIllustration)) {
        unlink($uploadDir . $oldIllustration);
        $this->imagineCacheManager->remove($oldIllustration);
    }

    try {
        $imageName = uniqid() . '.' . $illustration->guessExtension();
        $illustration->move($uploadDir, $imageName);
        $element->setIllustration($imageName);
        $this->imagineCacheManager->getBrowserPath($imageName, 'thumbnail');
    } catch (\Exception $e) {
        throw new \RuntimeException('Erreur lors du téléchargement de l\'illustration');
    }
}

private function handlePokemonForm(Pokemon $pokemon, Form $form): void
{
    $element = $form->get('element')->getData();
    if ($element !== null) {
        if ($form->has('illustration')) {
            $illustration = $form->get('illustration')->getData();
            if ($illustration instanceof UploadedFile) {
                $this->handleElementImageUpload($element, $illustration);
                $this->entityManager->persist($element);
            }
        }
        $pokemon->setElement($element);
    }

    $image = $form->get('image')->getData();
    if ($image instanceof UploadedFile) {
        $this->handleImageUpload($pokemon, $image);
    }
}

public function upload(Request $request, Pokemon $pokemon): Response
{
    try {
        $image = $request->files->get('image');
        if ($image) {
            $this->handleImageUpload($pokemon, $image);
            $this->addFlash('success', 'Image uploadée avec succès');
        }
        return $this->redirectToRoute('pokemon_show', ['id' => $pokemon->getId()]);
    } catch (\Exception $e) {
        $this->addFlash('error', $e->getMessage());
        return $this->redirectToRoute('pokemon_edit', ['id' => $pokemon->getId()]);
    }
}

}
