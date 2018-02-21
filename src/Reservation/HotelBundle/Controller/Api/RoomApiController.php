<?php

namespace Reservation\HotelBundle\Controller\Api;

use AppBundle\Exception\ApiException;
use Reservation\HotelBundle\Entity\Hotel;
use Reservation\HotelBundle\Entity\Room;
use Reservation\HotelBundle\HotelManager\RoomManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RoomApiController
 * @package Reservation\HotelBundle\Controller
 * @Route("api/rooms")
 */
class RoomApiController extends Controller
{


    /**
     * @param Room|null $room
     * @param RoomManager $manager
     * @return JsonResponse
     * @Route("/hotel/{id}" , name="api_rooms_of_hotel")
     * @Method({"GET"})
     */
    public function hotelRooms(Hotel $hotel = null, RoomManager $manager)
    {
        $roomResponse = [];
        try {
            $roomResponse = $manager->getHotelRooms($hotel);
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }
        return new JsonResponse($roomResponse);
    }

    /**
     * @param Room|null $room
     * @param RoomManager $manager
     * @return JsonResponse
     * @Route("/{id}" , name="api_rooms_details")
     * @Method({"GET"})
     */
    public function roomDetails(Room $room = null, RoomManager $manager)
    {
        $roomResponse = [];
        try {
            $roomResponse = $manager->getRoom($room);
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }
        return new JsonResponse($roomResponse);
    }

    /**
     *
     * @param RoomManager $manager
     * @return JsonResponse
     * @Route("/" , name="api_rooms_list")
     * @Method({"GET"})
     */
    public function listRooms(RoomManager $manager)
    {
        $rooms = [];
        try {
            $roomsResponse = $manager->getList();
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }

        return new JsonResponse($roomsResponse);
    }


}
