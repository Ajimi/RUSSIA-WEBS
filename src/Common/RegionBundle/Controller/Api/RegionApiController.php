<?php

namespace Common\RegionBundle\Controller\Api;

use AppBundle\Exception\ApiException;
use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Manager\RegionManager;
use Reservation\HotelBundle\Entity\Hotel;
use Reservation\HotelBundle\HotelManager\HotelManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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


}
