<?php

namespace App\Controller;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class FakeOpenMapController implements MapAddressInterface
{
    public static $statusCode = 200;
    public static $content = [];

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

        $coordinates = [
            'lat'               =>  $result->lat,
            'lng'               => $result->lon,
            'formatted_address' => $result->display_name,
        ];

        return $coordinates;

    }

}