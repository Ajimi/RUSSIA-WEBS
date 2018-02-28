<?php

namespace Common\RegionBundle\Controller\Api;

use AppBundle\Exception\ApiException;
use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Manager\RegionManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package Reservation\HotelBundle\Controller
 * @Route("api/regions")
 */
class RegionApiController extends Controller
{

    /**
     * @param Region|null $region
     * @param RegionManager $manager
     * @return Response
     * @Route("/{id}" , name="api_regions_details")
     * @Method({"GET"})
     */
    public function hotelDetails(Region $region = null, RegionManager $manager): Response
    {
        $regionResponse = [];
        try {
            $regionResponse = $manager->getRegion($region);
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }
        return new JsonResponse($regionResponse);
    }

    /**
     * @param RegionManager $manager
     * @return Response
     * @internal param $RegionManager
     * @Route("/" , name="api_regions_list")
     * @Method({"GET"})
     */
    public function listRegions(RegionManager $manager): Response
    {
        $regionsResponse = [];
        try {
            $regionsResponse = $manager->getList();
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }

        return new JsonResponse($regionsResponse);
    }

    /**
     * @param Request $request
     * @Route("/getLocation/{id}", name="api_location_id" , options={"expose" = true})
     * @return JsonResponse
     */
    public function getLocation(Request $request, Region $region)
    {

        return new JsonResponse(
            array('data' => array(
                'latitude' => $region->getLocation()->getGeoCode()->getLatitude(),
                'longitude' => $region->getLocation()->getGeoCode()->getLongitude()
            )
            )
        );
    }

}
