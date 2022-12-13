<?php

namespace App\Tests;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class OpenMapClientTest extends \PHPUnit\Framework\TestCase
{


    public function testFetchCoords() {

        $responses = [
            new MockResponse('[{"place_id":527958,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"node","osm_id":262893507,"boundingbox":["42.4732789","42.5532789","24.6548452","24.7348452"],"lat":"42.5132789","lon":"24.6948452","display_name":"Hisarya, Hisaria, Plovdiv, 4180, Bulgaria","class":"place","type":"town","importance":0.6527919850688202,"icon":"https://nominatim.openstreetmap.org/ui/mapicons/poi_place_town.p.20.png","address":{"town":"Hisarya","municipality":"Hisaria","county":"Plovdiv","ISO3166-2-lvl6":"BG-16","postcode":"4180","country":"Bulgaria","country_code":"bg"}},{"place_id":110287928,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":24599418,"boundingbox":["42.7040563","42.7058773","23.2934991","23.2940574"],"lat":"42.7048796","lon":"23.2937544","display_name":"Hisarya, Ilinden, zh.k. Sveta Troitsa, Ilinden, Sofia, Sofia City, Sofia-City, 1309, Bulgaria","class":"highway","type":"residential","importance":0.3,"address":{"road":"Hisarya","neighbourhood":"Ilinden","suburb":"zh.k. Sveta Troitsa","city_district":"Ilinden","city":"Sofia","municipality":"Sofia City","county":"Sofia-City","ISO3166-2-lvl6":"BG-22","postcode":"1309","country":"Bulgaria","country_code":"bg"}},{"place_id":282129485,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":957261248,"boundingbox":["42.7029224","42.7040563","23.2931309","23.2934991"],"lat":"42.7037652","lon":"23.2933977","display_name":"Hisarya, Ilinden, ж.к. Илинден, Ilinden, Sofia, Sofia City, Sofia-City, 1309, Bulgaria","class":"highway","type":"residential",
            "importance":0.3,"address":{"road":"Hisarya","neighbourhood":"Ilinden","suburb":"ж.к. Илинден","city_district":"Ilinden","city":"Sofia","municipality":"Sofia City","county":"Sofia-City","ISO3166-2-lvl6":"BG-22","postcode":"1309","country":"Bulgaria","country_code":"bg"}},{"place_id":185647887,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":332247217,"boundingbox":["42.2676303","42.2681108","23.1235823","23.1243642"],"lat":"42.2679408","lon":"23.1240876","display_name":"Hisarya, Dupnitsa, Kyustendil, 2600, Bulgaria","class":"highway","type":"residential","importance":0.3,"address":{"road":"Hisarya","town":"Dupnitsa","county":"Kyustendil","ISO3166-2-lvl6":"BG-10","postcode":"2600","country":"Bulgaria","country_code":"bg"}},{"place_id":153335838,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":204016531,"boundingbox":["41.6447134","41.6474245","24.1560794","24.1585857"],"lat":"41.6461831","lon":"24.1573367","display_name":"Hisarya, Dospat, Smolyan, 4831, Bulgaria","class":"highway","type":"residential","importance":0.3,"address":{"road":"Hisarya","town":"Dospat","municipality":"Dospat","county":"Smolyan","ISO3166-2-lvl6":"BG-21","postcode":"4831","country":"Bulgaria","country_code":"bg"}},{"place_id":112461202,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":30745915,"boundingbox":["42.7095224","42.7124022","23.1512047","23.1540973"],"lat":"42.7106962","lon":"23.1527265","display_name":"Hisarya, Sv. Stefan, Bankia, Sofia City, Sofia-City, 1393, Bulgaria","class":"highway","type":"residential",
            "importance":0.3,"address":{"road":"Hisarya","suburb":"Sv. Stefan","town":"Bankia","municipality":"Sofia City","county":"Sofia-City","ISO3166-2-lvl6":"BG-22","postcode":"1393","country":"Bulgaria","country_code":"bg"}},{"place_id":16815649,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"node","osm_id":1845693211,"boundingbox":["42.5063786","42.5064786","24.7013837","24.7014837"],"lat":"42.5064286","lon":"24.7014337","display_name":"Hisarya, Ivan Vazov blvd., Verigovo, Hisarya, Hisaria, Plovdiv, 4180, Bulgaria","class":"amenity","type":"post_office","importance":0.2001,"icon":"https://nominatim.openstreetmap.org/ui/mapicons/amenity_post_office.p.20.png","address":{"amenity":"Hisarya","road":"Ivan Vazov blvd.","suburb":"Verigovo","town":"Hisarya","municipality":"Hisaria","county":"Plovdiv","ISO3166-2-lvl6":"BG-16","postcode":"4180","country":"Bulgaria","country_code":"bg"}},{"place_id":52676397,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"node","osm_id":4571022763,"boundingbox":["42.505857","42.505957","24.7085107","24.7086107"],"lat":"42.505907","lon":"24.7085607","display_name":"Bulgaria, bul. Hristo Botev, Orfey r.c., Hisarya, Hisaria, Plovdiv, 4180, Bulgaria","class":"shop","type":"supermarket","importance":0.2001,"icon":"https://nominatim.openstreetmap.org/ui/mapicons/shopping_supermarket.p.20.png","address":{"shop":"Bulgaria","road":"bul. Hristo Botev","suburb":"Orfey r.c.","town":"Hisarya","municipality":"Hisaria","county":"Plovdiv","ISO3166-2-lvl6":"BG-16","postcode":"4180","country":"Bulgaria","country_code":"bg"}}]'),
            new MockResponse('[{"place_id":164391609,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":237029706,"boundingbox":["42.6988988","42.6990284","23.3419101","23.3451781"],"lat":"42.6989634","lon":"23.3434487","display_name":"Trakia, Oborishte, Sofia, Sofia City, Sofia-City, 1504, Bulgaria","class":"highway","type":"residential","importance":0.19999999999999998,"address":{"road":"Trakia","city_district":"Oborishte","city":"Sofia","municipality":"Sofia City","county":"Sofia-City","ISO3166-2-lvl6":"BG-22","postcode":"1504","country":"Bulgaria","country_code":"bg"}},{"place_id":163386578,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":237029707,"boundingbox":["42.6988425","42.6988988","23.3407319","23.3419101"],"lat":"42.6988988","lon":"23.3419101","display_name":"Trakiya, Oborishte, Sofia, Sofia City, Sofia-City, 1527, Bulgaria","class":"highway","type":"residential","importance":0.19999999999999998,"address":{"road":"Trakiya","city_district":"Oborishte","city":"Sofia","municipality":"Sofia City","county":"Sofia-City","ISO3166-2-lvl6":"BG-22","postcode":"1527","country":"Bulgaria","country_code":"bg"}},{"place_id":153994755,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"way","osm_id":206507621,"boundingbox":["42.7045961","42.7056868","23.1507357","23.150964"],"lat":"42.7045961","lon":"23.150964","display_name":"Trakia, Sv. Stefan, Bankia, Sofia City, Sofia-City, 1393, Bulgaria","class":"highway","type":"residential","importance":0.19999999999999998,
            "address":{"road":"Trakia","suburb":"Sv. Stefan","town":"Bankia","municipality":"Sofia City","county":"Sofia-City","ISO3166-2-lvl6":"BG-22","postcode":"1393","country":"Bulgaria","country_code":"bg"}}]'),
            new MockResponse('[{"place_id":13143715,"licence":"Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright","osm_type":"node","osm_id":1352312806,"boundingbox":["41.1227428","41.1627428","42.5781352","42.6181352"],"lat":"41.1427428","lon":"42.5981352","display_name":"Açıkyazı, Ardahan, Eastern Anatolia Region, Turkey","class":"place","type":"village","importance":0.30093879814957736,"icon":"https://nominatim.openstreetmap.org/ui/mapicons/poi_place_village.p.20.png","address":{"village":"Açıkyazı","city":"Ardahan","province":"Ardahan","ISO3166-2-lvl4":"TR-75","region":"Eastern Anatolia Region","country":"Turkey","country_code":"tr"}}]')
        ];

        $client = new MockHttpClient($responses);

        $response1 = $client->request('GET', 'https://nominatim.openstreetmap.org/search?q=hisarya+bulgaria&format=json&addressdetails=1&polygon_geojson=0');

        $result = json_decode($response1->getContent())[0];

        $this->assertEquals("42.5132789", round($result->lat,7));
        $this->assertEquals("24.6948452", round($result->lon, 7));
        $this->assertEquals("Hisarya, Hisaria, Plovdiv, 4180, Bulgaria" , $result->display_name);

        $this->assertTrue(-90 <= $result->lat && $result->lat <= 90);
        $this->assertTrue(-180 <= $result->lon && $result->lat <= 180);

        $response2 = $client->request('GET', 'https://nominatim.openstreetmap.org/search?q=43_trakia+sofia&format=json&addressdetails=1&polygon_geojson=0');

        $result = json_decode($response2->getContent())[0];

        $this->assertEquals("42.6989634", round($result->lat, 7));
        $this->assertEquals("23.3434487", round($result->lon, 7));
        $this->assertEquals("Trakia, Oborishte, Sofia, Sofia City, Sofia-City, 1504, Bulgaria" , $result->display_name);

        $this->assertTrue(-90 <= $result->lat && $result->lat <= 90);
        $this->assertTrue(-180 <= $result->lon && $result->lat <= 180);

        $response3 = $client->request('GET', 'https://nominatim.openstreetmap.org/search?q=alaBala&format=json&addressdetails=1&polygon_geojson=0');

        $result = json_decode($response3->getContent())[0];

        $this->assertEquals("41.1427428", round($result->lat,7));
        $this->assertEquals("42.5981352", round($result->lon, 7));
        $this->assertEquals("Açıkyazı, Ardahan, Eastern Anatolia Region, Turkey" , $result->display_name);

        $this->assertTrue(-90 <= $result->lat && $result->lat <= 90);
        $this->assertTrue(-180 <= $result->lon && $result->lat <= 180);
    }
}