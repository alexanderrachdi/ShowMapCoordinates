<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenMapClient implements MapAddressInterface
{

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchCoords(string $address) : array
    {
        $url = "https://nominatim.openstreetmap.org/search?q={$address}&format=json&addressdetails=1&polygon_geojson=0";
        $responce = $this->httpClient->request('GET', $url);

        if ($responce->getStatusCode() !== 200) {
            return ['error' => "Request error."];
        }

        if(empty(json_decode($responce->getContent()))) {
            return ['error' => "The address not existed in our database. Be more accurate."];
        }

        $result = json_decode($responce->getContent(), true)[0];

        return $result;

    }
}
