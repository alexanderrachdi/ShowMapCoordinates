<?php

namespace App\Tests;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class GoogleMapClientTest extends \PHPUnit\Framework\TestCase
{
    public function testFetchCoords() {

        $responses = [
            new MockResponse('{"results":[{"address_components":[{"long_name":"Hisarya","short_name":"Hisarya","types":["locality","political"]},{"long_name":"Plovdiv Province","short_name":"Plovdiv Province","types":["administrative_area_level_1","political"]},{"long_name":"Bulgaria","short_name":"BG","types":["country","political"]},{"long_name":"4180","short_name":"4180","types":["postal_code"]}],"formatted_address":"4180 Hisarya, Bulgaria","geometry":{"bounds":{"northeast":{"lat":42.5262233,"lng":24.730883},"southwest":{"lat":42.4815079,"lng":24.6855759}},"location":{"lat":42.5043656,"lng":24.7062087},"location_type":"APPROXIMATE","viewport":{"northeast":{"lat":42.5262233,"lng":24.730883},"southwest":{"lat":42.4815079,"lng":24.6855759}}},"place_id":"ChIJZzN3xULpqUAR8FS_aRKgAAQ","types":["locality","political"]}],"status":"OK"}'),
            new MockResponse('{"results":[{"address_components":[{"long_name":"4185","short_name":"4185","types":["street_number"]},{"long_name":"Wehrman Avenue","short_name":"Wehrman Ave","types":["route"]},{"long_name":"Schiller Park","short_name":"Schiller Park","types":["locality","political"]},{"long_name":"Leyden Township","short_name":"Leyden Township","types":["administrative_area_level_3","political"]},{"long_name":"Cook County","short_name":"Cook County","types":["administrative_area_level_2","political"]},{"long_name":"Illinois","short_name":"IL","types":["administrative_area_level_1","political"]},{"long_name":"United States","short_name":"US","types":["country","political"]},{"long_name":"60176","short_name":"60176","types":["postal_code"]},{"long_name":"1844","short_name":"1844","types":["postal_code_suffix"]}],"formatted_address":"4185 Wehrman Ave, Schiller Park, IL 60176, USA","geometry":{"location":{"lat":41.95455339999999,"lng":-87.87793069999999},"location_type":"RANGE_INTERPOLATED","viewport":{"northeast":{"lat":41.95590208029149,"lng":-87.87679031970849},"southwest":{"lat":41.9532041197085,"lng":-87.8794882802915}}},"place_id":"Ei40MTg1IFdlaHJtYW4gQXZlLCBTY2hpbGxlciBQYXJrLCBJTCA2MDE3NiwgVVNBIjESLwoUChIJc1cOFry1D4gRKEhen1D3d9YQ2SAqFAoSCYWe6PS8tQ-IEYLgeWzeIv1i","types":["street_address"]}],"status":"OK"}'),
        ];

        $client = new MockHttpClient($responses);

        $response1 = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=hisarya+bulgaria&key=AIzaSyCbgzprhvxyw5kHKR2mksfHOUxSR4_rQF4&sensor=false%27;');

        $result = json_decode($response1->getContent());

        $this->assertEquals("42.5043656", round($result->results[0]->geometry->location->lat, 7));
        $this->assertEquals("24.7062087", round($result->results[0]->geometry->location->lng, 7));
        $this->assertEquals("4180 Hisarya, Bulgaria" , $result->results[0]->formatted_address);

        $this->assertTrue(-90 <= $result->results[0]->geometry->location->lat && $result->results[0]->geometry->location->lat <= 90);
        $this->assertTrue(-180 <= $result->results[0]->geometry->location->lng && $result->results[0]->geometry->location->lng <= 180);

        $response2 = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=4185+wehrman+ave+schiller+park+chicago&key=AIzaSyCbgzprhvxyw5kHKR2mksfHOUxSR4_rQF4&sensor=false%27;');

        $result = json_decode($response2->getContent());

        $this->assertEquals("41.9545534", round($result->results[0]->geometry->location->lat, 7));
        $this->assertEquals("-87.8779307", round($result->results[0]->geometry->location->lng, 7));
        $this->assertEquals("4185 Wehrman Ave, Schiller Park, IL 60176, USA" , $result->results[0]->formatted_address);

        $this->assertTrue(-90 <= $result->results[0]->geometry->location->lat && $result->results[0]->geometry->location->lat <= 90);
        $this->assertTrue(-180 <= $result->results[0]->geometry->location->lng && $result->results[0]->geometry->location->lng <= 180);
    }
}