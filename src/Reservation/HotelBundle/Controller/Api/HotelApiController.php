<?php

namespace Reservation\HotelBundle\Controller\Api;

use AppBundle\Exception\ApiException;
use Reservation\HotelBundle\Entity\Hotel;
use Reservation\HotelBundle\HotelManager\HotelManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HotelApiController
 * @package Reservation\HotelBundle\Controller
 * @Route("api/hotels")
 */
class HotelApiController extends Controller
{


    /**
     * @param Hotel $hotel
     * @param HotelManager $manager
     * @return Response
     * @Route("/{hotel}/rooms" , name="api_hotels_rooms")
     * @Method({"GET"})
     */
    public function hotelRooms(Hotel $hotel = null, HotelManager $manager)
    {
        $hotelWithRoomsResponse = [];
        try {
            $hotelWithRoomsResponse = $manager->getHotelRooms($hotel);
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }
        return new JsonResponse($hotelWithRoomsResponse);
    }

    /**
     * @param Hotel|null $hotel
     * @param HotelManager $manager
     * @return Response
     * @Route("/{hotel}" , name="api_hotels_details")
     * @Method({"GET"})
     */
    public function hotelDetails(Hotel $hotel = null, HotelManager $manager)
    {
        $hotelResponse = [];
        try {
            $hotelResponse = $manager->getHotel($hotel);
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }
        return new JsonResponse($hotelResponse);
    }

    /**
     * @param HotelManager $manager
     * @return Response
     * @Route("/" , name="api_hotels_list")
     * @Method({"GET"})
     */
    public function listHotel(HotelManager $manager)
    {
        $hotels = [];
        try {
            $hotelsResponse = $manager->getList();
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }

        return new JsonResponse($hotelsResponse);
    }


}
