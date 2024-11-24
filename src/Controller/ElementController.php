<?php

namespace App\Controller;

use App\Entity\Element;
use App\Form\ElementType;
use App\Form\SearchingType;
use App\Repository\ElementRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $element = new Element();
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleIllustrationUpload($form, $element, $slugger);
            
            $this->entityManager->persist($element);
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Élément créé avec succès!');
            return $this->redirectToRoute('app_element_index');
        }
    
        return $this->render('element/new.html.twig', [
            'form' => $form->createView(),
            'element' => $element,
            'edit' => false,
            'backgroundImage' => $this->backgroundImages['new']
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_element_edit', methods: ['GET', 'POST'])]
    public function edit(Element $element, Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleIllustrationUpload($form, $element, $slugger);
            
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Élément modifié avec succès!');
            return $this->redirectToRoute('app_element_index');
        }
    
        return $this->render('element/form.html.twig', [
            'form' => $form,
            'element' => $element,
            'edit' => true,
            'backgroundImage' => $this->backgroundImages['edit']
        ]);
    }
    
    private function handleIllustrationUpload($form, Element $element, SluggerInterface $slugger): void
    {
        $illustrationFile = $form->get('illustration')->getData();
    
        if ($illustrationFile) {
            $originalFilename = pathinfo($illustrationFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $illustrationFile->guessExtension();
    
            try {
                $illustrationFile->move(
                    $this->getParameter('elements_directory'),
                    $newFilename
                );
                
                if ($element->getIllustration()) {
                    $oldFile = $this->getParameter('elements_directory') . '/' . $element->getIllustration();
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                
                $element->setIllustration($newFilename);
            } catch (FileException $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de l\'upload du fichier');
                throw $e;
            }
        }
    }
    

    #[Route('/{id}', name: 'app_element_show', methods: ['GET'])]
    public function show(Element $element): Response
    {
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

    private function handleElementForm(Element $element, $form, EntityManagerInterface $entityManager): void
    {
        $illustration = $form->get('illustration')->getData();
        if ($illustration !== null) {
            if ($element->getIllustration() !== null) {
                $oldIllustrationPath = $this->getParameter('element_illustration_directory') . '/' . $element->getIllustration();
                if (file_exists($oldIllustrationPath)) {
                    unlink($oldIllustrationPath);
                    $this->imagineCacheManager->remove($element->getIllustration());
                }
            }

            $illustrationName = uniqid() . '.' . $illustration->guessExtension();
            $element->setIllustration($illustrationName);
            $illustration->move($this->getParameter('element_illustration_directory'), $illustrationName);

            // Générer les versions redimensionnées de l'image
            $this->imagineCacheManager->getBrowserPath($illustrationName, 'thumbnail');
        }

        $entityManager->persist($element);
        $entityManager->flush();
    }
}