<?php

namespace App\Controller;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleMapClient implements MapAddressInterface
{

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {

        $this->httpClient = $httpClient;
    }

    public function fetchCoords(string $address): array
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCbgzprhvxyw5kHKR2mksfHOUxSR4_rQF4&sensor=false%27;";
        $responce = $this->httpClient->request('GET', $url);

        if ($responce->getStatusCode() !== 200) {
            return ['error' => "Request error.Trye again later!"];
        }

        if(empty(json_decode($responce->getContent()))) {
            return ['error' => "The address not existed in our database. Be more accurate."];
        }

        $result = json_decode($responce->getContent());

        return $result;

    }
}