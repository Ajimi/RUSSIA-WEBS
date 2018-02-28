<?php

namespace Common\RegionBundle\Controller\Api;

use AppBundle\Exception\ApiException;
use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Manager\PlaceManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("api/places")
 */
class PlaceApiController extends Controller
{

    /**
     * @param Place|null $place
     * @param PlaceManager $manager
     * @return Response
     * @Route("/{id}" , name="api_place_details")
     * @Method({"GET"})
     */
    public function placeDetails(Place $place = null, PlaceManager $manager): Response
    {
        $placeResponse = [];
        try {
            $placeResponse = $manager->getPlace($place);
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }
        return new JsonResponse($placeResponse);
    }

    /**
     * @param PlaceManager $manager
     * @return Response
     * @internal param $PlaceManager
     * @Route("/" , name="api_place_list")
     * @Method({"GET"})
     */
    public function listPlaces(PlaceManager $manager): Response
    {
        $placesResponse = [];
        try {
            $placesResponse = $manager->getList();
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }

        return new JsonResponse($placesResponse);
    }

    /**
     * @param Request $request
     * @Route("/getLocation/{id}", name="api_location_id" , options={"expose" = true})
     * @return JsonResponse
     */
    public function getLocation(Request $request, Place $place)
    {

        return new JsonResponse(
            array(
                'data' => array(
                    'latitude' => $place->getLocation()->getGeoCode()->getLatitude(),
                    'longitude' => $place->getLocation()->getGeoCode()->getLongitude()
                )
            )
        );
    }

}
