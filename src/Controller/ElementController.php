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
        'index' => 'ciel_etoile.webp',
        'new' => 'AdobeStock_585885970.webp',
        'edit' => 'AdobeStock_585885970.webp',
        'show' => 'ciel_etoile.webp'
    ];


    public function __construct(
        private EntityManagerInterface $entityManager,
        private CacheManager $imagineCacheManager
    ) {
    }
    
    #[Route('/', name: 'app_element_index', methods: ['GET'])]
    public function index(ElementRepository $elementRepository): Response
    { 
        return $this->render('element/index.html.twig', [
            'elements' => $elementRepository->findAll(),
            'bodyClass' => 'liste-energies',
            // on inclue le bg dnas le render
            'backgroundImage' => $this->backgroundImages['index']
        ]);
    }

    #[Route('/new', name: 'app_element_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/edit', name: 'app_element_edit', methods: ['GET', 'POST'])]
    public function form(
        Request $request,
        SluggerInterface $slugger,
        ?Element $element = null
    ): Response {
        $element = $element ?? new Element();
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
                    
                    // Supprime l'ancienne image si elle existe
                    if ($element->getIllustration()) {
                        $oldFile = $this->getParameter('elements_directory') . '/' . $element->getIllustration();
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                    
                    $element->setIllustration($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'upload du fichier');
                    return $this->redirectToRoute('element_index');
                }
            }

            $this->entityManager->persist($element);
            $this->entityManager->flush();

            $this->addFlash('success', 'Élément ' . ($element->getId() ? 'modifié' : 'créé') . ' avec succès!');
            return $this->redirectToRoute('element_index');
        }

        return $this->render('element/form.html.twig', [
            'form' => $form,
            'element' => $element,
            'edit' => $element->getId() !== null,
        ]);
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
