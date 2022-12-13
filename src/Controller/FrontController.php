<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
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
    public function index(Request $request): Response {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/app_geolocation", "app_geolocation")
     */
    public function symfonyGeolocation(Request $request): Response {
        $coordinates = [];
        if($request->isMethod('post')) {
            $address = urlencode(trim($request->request->get('address')));
            $coordinates = $this->mapControl->fetchCoords($address);
            if(array_key_exists('error', $coordinates)) {
                $request->getSession()
                    ->getFlashBag()
                    ->add('error', $coordinates['error']);
            }
        }
        if(empty($coordinates) || !empty($coordinates['error'])){
            $coordinates = array('lat' => 51.505, 'lon' => '-0.09', 'display_name' => 'Select address');
        }

        return $this->render('leaflet.html.twig', array('coordinates' => $coordinates));
    }


    public function getAddress(Request $request): JsonResponse {
        $address = urlencode(trim($request->get('address')));
        $coordinates = $this->mapControl->fetchCoords($address);
        if(empty($coordinates) || !empty($coordinates['error'])){
            return new JsonResponse(['error' => 'data not found'], 404);
        }

        return new JsonResponse($coordinates, 200, ["Content-Type" => "application/json"]);
    }

}
