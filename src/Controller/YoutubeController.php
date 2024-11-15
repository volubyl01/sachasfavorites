<?php

namespace App\Controller;

use App\Form\YoutubeType;
use App\Service\YoutubeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class YoutubeController extends AbstractController
{
    #[Route('/youtube-search', name: 'app_youtube_search')]
    public function search(YoutubeService $youtubeService, Request $request, $query = null): Response
    {
        $form = $this->createForm(YoutubeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->get('query')->getData();
            // $title = $form->get('title')->getData();
            $regionCode = $form->get('region_code')->getData();
            $videoCategory = $form->get('video_category_id')->getData();
            $maxResults = $form->get('max_results')->getData();

            // Récupérer la clé API depuis les paramètres de configuration ou une variable d'environnement
            $apiKey = $this->getParameter('app.youtube_api_key');

            $videos = $youtubeService->searchVideos($query, $maxResults, $apiKey, $videoCategory, $regionCode);

            return $this->render('youtube/search.html.twig', [
                'videos' => $videos,
                'query' => $query,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('youtube/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
