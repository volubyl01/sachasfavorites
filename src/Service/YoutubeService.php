<?php

namespace App\Service;

use Exception;
use Google\Client;
use Google\Service\YouTube;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class YoutubeService
{
    private $youtube;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $client = new Client();
        $client->setDeveloperKey($apiKey);
        $this->youtube = new YouTube($client);
    }

    public function searchVideos($query, $maxResults, $title)
    {
        try {
            // Effectuer une requête de recherche de vidéos à l'API YouTube
            $searchResponse = $this->youtube->search->listSearch('id,snippet', [
                'q' => $query,
                'maxResults' => $maxResults,
                'type' => 'video',
                'fields' => 'items(id/videoId,snippet/title,snippet/description,snippet/thumbnails/default)',
            ]);

            $videos = [];
            foreach ($searchResponse->items as $searchResult) {
                if (isset($searchResult->id->videoId, $searchResult->snippet->title, $searchResult->snippet->description, $searchResult->snippet->thumbnails->default->url)) {
                    $videos[] = [
                        'id' => $searchResult->id->videoId,
                        'title' => $searchResult->snippet->title,
                        'description' => $searchResult->snippet->description,
                        'thumbnailUrl' => $searchResult->snippet->thumbnails->default->url,
                    ];
                }
            }

            return $videos;
        } catch (Exception $e) {
            // Gérer les erreurs de l'API
            throw new Exception('Erreur lors de la recherche de vidéos sur YouTube : ' . $e->getMessage());
        }
    }
}
