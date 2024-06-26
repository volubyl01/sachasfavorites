<?php

namespace App\Controller;


use App\Entity\Element;
use App\Form\ElementType;

use App\Form\SearchingType;

use App\Repository\ElementRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/element')]
class ElementController extends AbstractController
{
    #[Route('/', name: 'app_element_index', methods: ['GET'])]
    public function index(ElementRepository $elementRepository): Response
    { 
        return $this->render('element/index.html.twig', [
            'elements' => $elementRepository->findAll(),
            'bodyClass' => 'liste-energies'
        ]);
    }

    #[Route('new', name: 'app_element_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $element = new Element();
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($element);
            $entityManager->flush();

            return $this->redirectToRoute('app_element_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('element/new.html.twig', [
            'element' => $element,
            'form' => $form,
            'bodyClass'=> 'new-element'
        ]);
    }

    #[Route('/{id}', name: 'app_element_show', methods: ['GET'])]
    public function show(Element $element): Response
    {
        return $this->render('element/show.html.twig', [
            'element' => $element,
        ]);
    }
    #[Route('/element/{id}', name: 'app_element_show')]
    public function showElement(int $id, ElementRepository $elementRepository): Response
    {
        $element = $elementRepository->find($id);

        if (!$element) {
            throw $this->createNotFoundException('Element not found');
        }

        return $this->render('element/show.html.twig', [
            'element' => $element,
        ]);
    }
// FONCTION EDITION
    #[Route('/{id}/edit', name: 'app_element_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Element $element, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           
            // $entityManager->flush(); par défaut
             //on introduit une image dan sl'édition : 
            $illustration = $form->get('illustration')->getData();
            // je vérfie qu'une nouvelle image a été envoyée au formulaire
            if ($illustration !== null) {
                // je vérifie l'existence d'une ancienne image de l'élément
                // si c'est le cas je supprime l'ancienne image
                if ($element->getIllustration() !== null && file_exists('element_illustration_directory' . $element->getIllustration())) {
                    unlink('element_illustration_directory' . $element->getIllustration());
                }

                // puis je télécharge la nouvelle image et change le nom de l'image en BDD

                $illustrationName = uniqid() . '.' . $illustration->guessExtension();
                $element->setIllustration($illustrationName);
                $illustration->move($this->getParameter('element_illustration_directory'), $illustrationName);
        }

// on conserve les données pour enregistrement
        $entityManager->persist($element);
        $entityManager->flush();

  return $this->redirectToRoute('app_element_index', [], Response::HTTP_SEE_OTHER); 
    }
        return $this->render('element/edit.html.twig', [
            'element' => $element,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_element_delete', methods: ['POST'])]
    public function delete(Request $request, Element $element, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$element->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($element);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_element_index', [], Response::HTTP_SEE_OTHER);
    }
}
