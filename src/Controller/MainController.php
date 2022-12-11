<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @var OpenMapClient
     */
    private $mapControl;

    public function __construct(OpenMapClient $mapControl)
    {
        $this->mapControl = $mapControl;
    }

    /**
     * @Route("/", "app_map_page")
     */
    public function index(Request $request) {

        if($request->isMethod('post')) {
            $address = urlencode(trim($request->request->get('address')));
            $coordinates = $this->mapControl->fetchCoords($address);
            if(array_key_exists('error', $coordinates)) {
                $request->getSession()
                    ->getFlashBag()
                    ->add('error', $coordinates['error']);
                return $this->render('index.html.twig');
            }

            return $this->render('leaflet.html.twig', array('coordinates' => $coordinates));
        }

        return $this->render('index.html.twig');
    }

//    /**
//     * @Route("/geocode", "Address_geocode")
//     *
//     * @param Request $request
//     */
//    public function geocode(Request $request)
//    {
//        var_dump($request->request->get('address'));die();
//
//        $api_key = "AIzaSyCbgzprhvxyw5kHKR2mksfHOUxSR4_rQF4";
//
//        $find = urlencode(trim($request->request->get('address')));
//
//        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$find}&key={$api_key}";
//
//        $resp_json = file_get_contents($url);
//
//        $resp = json_decode($resp_json, true);
//
//        if($resp['status']=='OK') {
//            // get the important data
//        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
//        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
//        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
//
//            if($lati && $longi && $formatted_address) {
//                // put the data in the array
//                $data_arr = array();
//
//                array_push(
//                    $data_arr,
//                    $lati,
//                    $longi,
//                    $formatted_address
//                );
//
//                return $this->render('leaflet.html.twig', array('coordinates' => $data_arr));
//            } else {
//                return false;
//            }
//        }else{
//            echo "<strong>ERROR: {$resp['status']}</strong>";
//            return false;
//        }
//    }

}