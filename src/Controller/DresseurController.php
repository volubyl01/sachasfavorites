<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Dresseur;
use App\Form\Dresseur1Type;
use App\Repository\DresseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/dresseur')]
class DresseurController extends AbstractController
{

 // on chisiit ses backgrounds par méthode
 private $backgroundImages = [
    'index' => 'pokeball-pokemon-pngrepo-com.webp',
    'new' => 'pokeball-pokemon-pngrepo-com.webp',
    'edit' => 'pokeball-pokemon-pngrepo-com.webp',
    'show' => 'pokeball-pokemon-pngrepo-com.webp',
];



    #[Route('/', name: 'app_dresseur_index', methods: ['GET'])]
    public function index(DresseurRepository $dresseurRepository): Response
    {
        return $this->render('dresseur/index.html.twig', [
            'dresseurs' => $dresseurRepository->findAll(),
            'backgroundImage' => $this->backgroundImages['index']
        ]);
    }

    #[Route('/new', name: 'app_dresseur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dresseur = new Dresseur();
        $form = $this->createForm(Dresseur1Type::class, $dresseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dresseur);
            $entityManager->flush();

            return $this->redirectToRoute('app_dresseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dresseur/new.html.twig', [
            'dresseur' => $dresseur,
            'form' => $form,
            'backgroundImage' => $this->backgroundImages['new']
        ]);
    }

    #[Route('/{id}', name: 'app_dresseur_show', methods: ['GET'])]
    public function show(Dresseur $dresseur): Response
    {
        return $this->render('dresseur/show.html.twig', [
            'dresseur' => $dresseur,
            'teams' => $dresseur->getTeams(),
            'backgroundImage' => $this->backgroundImages['show']
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dresseur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dresseur $dresseur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Dresseur1Type::class, $dresseur);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        $this->addFlash('success', 'Le dresseur a été modifié avec succès.');

        return $this->redirectToRoute('app_dresseur_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('dresseur/edit.html.twig', [
        'dresseur' => $dresseur,
        'form' => $form,
        'backgroundImage' => $this->backgroundImages['edit']
    ]);
    }

    #[Route('/{id}', name: 'app_dresseur_delete', methods: ['POST'])]
    public function delete(Request $request, Dresseur $dresseur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dresseur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dresseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dresseur_index', [], Response::HTTP_SEE_OTHER);
    }
}
