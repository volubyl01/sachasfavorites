<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;

use App\Form\SearchingType;
use App\Repository\ElementRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/pokemon')]
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
            $searchText = $form->get("Name")->getData();
            $pokemons = $pokemonRepository->search($searchText);
// **********
            //     return $this->redirectToRoute(
            //         'app_pokemon_search',
            //         ['text' =>$form->get('text')->getData()]
            //     );
        }

        if ($request->query->get('id') !== null) {
            $elementId = $request->query->get('id');
            $pokemons = $pokemonRepository->findBy(['element' => $elementId], ['id'=>'DESC']);
        }


        return $this->render('pokemon/index.html.twig', [
            'form' => $form,
            'pokemons' => $pokemons,
            'elements' => $elements
        ]);
    }



    #[Route('/new', name: 'app_pokemon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager , ElementRepository $elementrepository) : Response
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
            'pokemon' => $pokemon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pokemon_show', methods: ['GET'])]
    public function show(Pokemon $pokemon): Response
    {
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
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

        return $this->render('pokemon/edit.html.twig', [
            'pokemon' => $pokemon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pokemon_delete', methods: ['POST'])]
    public function delete(Request $request, Pokemon $pokemon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokemon->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($pokemon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pokemon_index', [], Response::HTTP_SEE_OTHER);
    }
}
