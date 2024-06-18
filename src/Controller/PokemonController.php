<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;



use App\Form\ElementType;
use App\Entity\Element;
use App\Form\SearchingType;
use App\Repository\ElementRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/monpokemon')]
class PokemonController extends AbstractController
{
    #[Route('/', name: 'app_pokemon_index', methods: ['GET'])]
    public function index(PokemonRepository $pokemonRepository, ElementRepository $elementRepository, Request $request): Response
    {

        // on introduit les possibilités de recherche
        $form = $this->createForm(SearchingType::class, null, ['method' => 'GET']);
        $form->handleRequest($request);


        $pokemons = $pokemonRepository->findAll();
        $elements = $elementRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $searchName = $form->get('name')->getData();
            $searchSpecificite = $form->get('specificite')->getData();

            if (!empty($searchName)) {
                $pokemons = $pokemonRepository->searchByName($searchName);
            } elseif (!empty($searchSpecificite)) {
                $pokemons = $pokemonRepository->searchBySpecificite($searchSpecificite);
            }
        }

        usort($pokemons, function($a, $b) {
            return strcasecmp($a->getName(), $b->getName());
        });

        return $this->render('pokemon/index.html.twig', [
            'form' => $form,
            'pokemons' => $pokemons,
            'element' => $elements,
            // 'bodyClass' => 'liste-pokemons',
        ]);
        // *****fin méthode recherche
    }



    #[Route('/new', name: 'app_pokemon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ElementRepository $elementrepository): Response
    {
        $pokemon = new Pokemon();
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image !== null) {
                $imageName = uniqid() . '.' . $image->guessExtension();
                $pokemon->setImage($imageName);
                $image->move('uploads/Image/', $imageName);
            }
            $entityManager->persist($pokemon);
            $entityManager->flush();

            return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($pokemon);
            $entityManager->flush();

            return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pokemon/new.html.twig', [
            // je crée une classe pour la page new-pokemon pour pouvoir ensuite choisir un fond de page personnalisé : je récupère la classe dans le template de bae (base.html.twig")
            'bodyClass' => 'new-pokemon',
            'pokemon' => $pokemon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pokemon_show', methods: ['GET'])]
    public function show(Pokemon $pokemon): Response
    {
        $element = $pokemon->getElement();
        if ($element !== null) {
            $illustration = $element->getIllustration();
        } else {
            $illustration = null;
        }
        
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
            'illustration' => $illustration,
            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pokemon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pokemon $pokemon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            // je vérfie qu'une nouvelle image a été envoyée au formulaire
            if ($image !== null) {
                // je vérifie l'existence d'une ancienne image du produit
                // si c'est le cas je supprime l'ancienne image
                if ($pokemon->getImage() !== null && file_exists('pokemon_image_directory' . $pokemon->getImage())) {
                    unlink('pokemon_image_directory' . $pokemon->getImage());
                }

                // puis je télécharge la nouvelle image et change le nom de l'image en BDD

                $imageName = uniqid() . '.' . $image->guessExtension();
                $pokemon->setImage($imageName);
                $image->move($this->getParameter('pokemon_image_directory'), $imageName);
            }

            $entityManager->persist($pokemon);
            $entityManager->flush();

            return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
        }
        $element = $pokemon->getElement();
        $illustration = $element->getIllustration($pokemon);

        return $this->render('pokemon/edit.html.twig', [
            'pokemon' => $pokemon,
            'illustration' => $illustration,
            'element' => $element,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pokemon_delete', methods: ['POST'])]
    public function delete(Request $request, Pokemon $pokemon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pokemon->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($pokemon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
    }
// soumission du formulaire
// public function soumission(Request $request)
// {
//     $form = $this->createForm(SearchingType::class, null);

//     // Traitement de la soumission du formulaire
//     $form->handleRequest($request);

//     if ($form->isSubmitted() && $form->isValid()) {
//         $data = $form->getData();
//         // Traiter les données du formulaire ici
//         // ...
//     }

//     return $this->render('pokemon/index.html.twig', [
//         'form' => $form->createView(),
//         // Autres variables à passer au template
//     ]);
// }
}
