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

        $responce = $this->httpClient->request('GET', "https://nominatim.openstreetmap.org/?addressdetails=1&q={$address}&format=json&limit=1");
        if ($responce->getStatusCode() !== 200) {
            return ['error' => "Request error.Trye again later!"];
        }

        if(empty(json_decode($responce->getContent()))) {
            return ['error' => "The address not existed in our database. Be more accurate."];
        }

        $result = json_decode($responce->getContent())[0];

        $coordinates = [
            'lat'               => $result->lat,
            'lng'               => $result->lon,
            'formatted_address' => $result->display_name,
        ];

        return $coordinates;

    }
}