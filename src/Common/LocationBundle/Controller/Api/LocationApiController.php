<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/13/2018
 * Time: 11:06 AM
 */

namespace Common\LocationBundle\Controller\Api;


use AppBundle\Exception\ApiException;
use Common\LocationBundle\Entity\Location;
use Common\LocationBundle\Manager\LocationManager;
use Reservation\HotelBundle\HotelManager\HotelManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class LocationApiController
 * @package Common\LocationBundle\Controller\Api
 * @Route("api/locations")
 */
class LocationApiController extends Controller
{
    /**
     * @Route("/{id}" , name="api_location_details")
     * @Method({"GET"})
     * @param Location|null $location
     * @param LocationManager $manager
     * @return JsonResponse
     */
    public function locationDetails(Location $location = null, LocationManager $manager)
    {
        $locationResponse = [];
        try {
            $locationResponse = $manager->getLocation($location);
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }
        return new JsonResponse($locationResponse);
    }

    /**
     * @Route("/" , name="api_locations_list")
     * @Method({"GET"})
     * @param LocationManager $manager
     * @return JsonResponse
     */
    public function listHotel(LocationManager $manager)
    {
        $hotels = [];
        try {
            $locationsResponse = $manager->getList();
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }

        return new JsonResponse($locationsResponse);
    }
}