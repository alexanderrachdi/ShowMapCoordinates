<?php

namespace App\Tests;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class OpenMapClientTest extends \PHPUnit\Framework\TestCase
{


    public function testFetchCoords() {

        $responses = [
            new MockResponse('[{"place_id":527958,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"node","osm_id":262893507,"boundingbox":["42.4732789","42.5532789","24.6548452","24.7348452"],"lat":"42.5132789","lon":"24.6948452","display_name":"Hisarya, Hisaria, Plovdiv, 4180, Bulgaria","class":"place","type":"town","importance":0.6527919850688202,"icon":"https://nominatim.openstreetmap.org/ui/mapicons/poi_place_town.p.20.png","address":{"town":"Hisarya","municipality":"Hisaria","county":"Plovdiv","ISO3166-2-lvl6":"BG-16","postcode":"4180","country":"Bulgaria","country_code":"bg"}}]'),
            new MockResponse('[{"place_id":164391609,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":237029706,"boundingbox":["42.6988988","42.6990284","23.3419101","23.3451781"],"lat":"42.6989634","lon":"23.3434487","display_name":"Trakia, Oborishte, Sofia, Sofia City, Sofia-City, 1504, Bulgaria","class":"highway","type":"residential","importance":0.19999999999999998,"address":{"road":"Trakia","city_district":"Oborishte","city":"Sofia","municipality":"Sofia City","county":"Sofia-City","ISO3166-2-lvl6":"BG-22","postcode":"1504","country":"Bulgaria","country_code":"bg"}}]'),
        ];

        $client = new MockHttpClient($responses);

        $response1 = $client->request('GET', 'https://nominatim.openstreetmap.org/?addressdetails=1&q=hisarya+bulgaria&format=json&limit=1');

        $result = json_decode($response1->getContent())[0];

        $this->assertEquals("42.5132789", $result->lat);
        $this->assertEquals("24.6948452", $result->lon);
        $this->assertEquals("Hisarya, Hisaria, Plovdiv, 4180, Bulgaria" , $result->display_name);

        $this->assertTrue(-90 <= $result->lat && $result->lat <= 90);
        $this->assertTrue(-180 <= $result->lon && $result->lat <= 180);

        $response2 = $client->request('GET', 'https://nominatim.openstreetmap.org/?addressdetails=1&q=43_trakia+sofia&format=json&limit=1');

        $result = json_decode($response2->getContent())[0];

        $this->assertEquals("42.6989634", $result->lat);
        $this->assertEquals("23.3434487", $result->lon);
        $this->assertEquals("Trakia, Oborishte, Sofia, Sofia City, Sofia-City, 1504, Bulgaria" , $result->display_name);

        $this->assertTrue(-90 <= $result->lat && $result->lat <= 90);
        $this->assertTrue(-180 <= $result->lon && $result->lat <= 180);
    }
}