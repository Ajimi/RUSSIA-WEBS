<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 2:33 PM
 */

namespace Reservation\HotelBundle\HotelManager;


use AppBundle\Exception\ApiException;
use Common\LocationBundle\Entity\Location;
use Common\LocationBundle\Manager\LocationManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\Entity\Hotel;

class HotelManager extends Manager
{
    private $entityManager;
    private $repository;
    private $roomManager;
    private $locationManager;

    /**
     * HotelManager constructor.
     * @param EntityManager $entityManager
     * @param RoomManager $roomManager
     * @param LocationManager $locationManager
     */
    public function __construct(EntityManager $entityManager, RoomManager $roomManager, LocationManager $locationManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("HotelBundle:Hotel");
        $this->roomManager = $roomManager;
        $this->locationManager = $locationManager;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }

    /**
     * @return array
     * @throws ApiException
     * @internal param array $
     */
    public function getList()
    {
        $hotels = $this->repository->findAll();
        $this->throwApiException($hotels, "Empty list of hotels");

        $data = $this->hotelSerialization($hotels);

        return $data;
    }



    /**
     * @param Hotel $hotel
     * @return array
     * @throws ApiException
     */
    public function getHotel(Hotel $hotel = null)
    {
        $this->throwApiException($hotel, "Hotel Object not found");
        $data = array('hotel' => array());
        $data["hotel"] = $this->serializeHotel($hotel);

        $rooms = $this->roomManager->getHotelRooms($hotel);
        $data["hotel"]["rooms"] = [];
        $data["hotel"]["rooms"] = $rooms["rooms"];

        $location = $this->locationManager->getLocation($hotel->getLocation());
        $data["hotel"]["location"] = $location;

        return $data;
    }


    /**
     * @param Hotel|null $hotel
     * @return array
     * @throws ApiException
     */
    public function getHotelRooms(Hotel $hotel = null)
    {

        $this->throwApiException($hotel, "Hotel Object not found");
        $data = array('hotel' => array());
        $data["hotel"] = $this->serializeHotel($hotel);

        $rooms = $this->roomManager->getHotelRooms($hotel);
        $data["hotel"]["rooms"] = [];
        $data["hotel"]["rooms"] = $rooms["rooms"];

        $location = $this->locationManager->getLocation($hotel->getLocation());
        $data["hotel"]["location"] = $location;

        return $data;
    }

    /**
     * @param Hotel $hotel
     * @return array
     */
    private function serializeHotel(Hotel $hotel)
    {
        return array(
            "id" => $hotel->getId(),
            "name" => $hotel->getName(),
            "availableRooms" => $hotel->getAvailableRooms(),
            "rate" => $hotel->getRate(),
            "stars" => $hotel->getStars(),
        );
    }

    /**
     * @param $hotels
     * @return array
     */
    private function hotelSerialization($hotels): array
    {
        $data = array('hotels' => array());
        foreach ($hotels as $hotel) {
            $data['hotels'][] = $this->serializeHotel($hotel);
        }
        return $data;
    }

}