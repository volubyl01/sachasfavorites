<?php  
namespace App\Controller\API;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;


class ApiService
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchApiData()
    {
        $response = $this->httpClient->request('GET', 'https://pokeapi.co/api/v2/pokemon/');

        if ($response->getStatusCode() === 200) {
            return $response->getContent();
        }

        throw new \Exception('Erreur lors de l\'appel à l\'API');
    }
}
