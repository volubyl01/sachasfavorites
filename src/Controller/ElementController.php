<?php

namespace App\Controller;

use App\Entity\Element;
use App\Form\ElementType;
use App\Form\SearchingType;
use App\Repository\ElementRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/element')]
class ElementController extends AbstractController
{

// on chisiit ses backgrounds par méthode
    private $backgroundImages = [
        'index' => 'images/backgrounds/ciel_etoile.webp',
        'new' => 'images/backgrounds/ciel_etoile.webp',
        'edit' => 'images/backgrounds/ciel_etoile.webp',
        'show' => 'images/backgrounds/ciel_etoile.webp'
    ];


    public function __construct(
        private EntityManagerInterface $entityManager,
        private readonly ElementRepository $elementRepository,
        private CacheManager $imagineCacheManager
    ) {
    }
    
    #[Route('/', name: 'app_element_index', methods: ['GET'])]
    public function index(): Response
    { 
        return $this->render('element/index.html.twig', [
            'elements' => $this->elementRepository->findAll(),
            'bodyClass' => 'liste-energies',
            // on inclue le bg dnas le render
            'backgroundImage' => $this->backgroundImages['index']
        ]);
    }

    #[Route('/new', name: 'app_element_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $element = new Element();
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleElementForm($element, $form);
            $this->entityManager->persist($element);
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Élément créé avec succès!');
            return $this->redirectToRoute('app_element_index');
        }
    
        return $this->render('element/new.html.twig', [
            'element' => $element,
            'edit' => false,
            'form' => $form->createView(),
            'backgroundImage' => $this->backgroundImages['new']
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_element_edit', methods: ['GET', 'POST'])]
    public function edit(Element $element, Request $request): Response
    {
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleElementForm($element, $form);
           
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Élément modifié avec succès!');
            return $this->redirectToRoute('app_element_index');
        }
    
        return $this->render('element/edit.html.twig', [
            'form' => $form->createView(),
            'element' => $element,
            'edit' => true,
            'backgroundImage' => $this->backgroundImages['edit']
        ]);
    }
    

    #[Route('/{id}', name: 'app_element_show', methods: ['GET'])]
    public function show(Element $element): Response
    {
        if (!$element) {
            throw $this->createNotFoundException('Element non trouvé');
        }
        return $this->render('element/show.html.twig', [
            'element' => $element,
            'backgroundImage' => $this->backgroundImages['show']
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
// intégration de liipimagebundle

private function handleElementForm(Element $element, FormInterface $form): void
{
    $illustrationFile = $form->get('illustration')->getData();

    if ($illustrationFile) {
        // Suppression de l'ancienne image si elle existe
        if ($element->getIllustration()) {
            $oldIllustrationPath = $this->getParameter('upload_directory') . '/' . $element->getIllustration();
            if (file_exists($oldIllustrationPath)) {
                unlink($oldIllustrationPath);
                $this->imagineCacheManager->remove($element->getIllustration());
            }
        }

        // Création du nouveau nom de fichier
        $newFilename = uniqid() . '.' . $illustrationFile->guessExtension();
        
        try {
            // Déplacement du fichier
            $illustrationFile->move(
                $this->getParameter('upload_directory'),
                $newFilename
            );
            
            $element->setIllustration($newFilename);

            // Générer les versions redimensionnées de l'image
            $this->imagineCacheManager->getBrowserPath($newFilename, 'thumbnail');
        } catch (FileException $e) {
            $this->addFlash('error', 'Une erreur est survenue lors de l\'upload du fichier');
            throw $e;
        }
    }
}
}