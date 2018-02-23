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

/**
 * Class HotelManager
 * @package Reservation\HotelBundle\HotelManager
 */
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
        $this->isEmpty($hotels, "Empty list of hotels");

        return $this->serializer($hotels);
    }



    /**
     * @param Hotel $hotel
     * @return array
     * @throws ApiException
     */
    public function getHotel(Hotel $hotel = null)
    {
        $this->isEmpty($hotel, "Hotel Object not found");
        $data = array('hotel' => array());
        /** @var Hotel $hotel */
        $data["hotel"] = $this->serialize($hotel);

        $rooms = $this->roomManager->getHotelRooms($hotel);
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

        $this->isEmpty($hotel, "Hotel Object not found");
        $data = array('hotel' => array());
        $data["hotel"] = $this->serialize($hotel);

        $rooms = $this->roomManager->getHotelRooms($hotel);
        $data["hotel"]["rooms"] = $rooms["rooms"];

        $location = $this->locationManager->getLocation($hotel->getLocation());
        $data["hotel"]["location"] = $location;

        return $data;
    }

    /**
     * @param Hotel $hotel
     * @return array
     */
    private function serialize(Hotel $hotel)
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
    public function serializer($hotels): array
    {
        $data = array('hotels' => array());
        foreach ($hotels as $hotel) {
            $hotelData = $this->serialize($hotel);
            try {
                $rooms = $this->roomManager->getHotelRooms($hotel);

                $hotelData['rooms'] = $rooms["rooms"];
            } catch (ApiException $exception) {
                $hotelData['rooms'] = [];
            }

            try {
                $location = $this->locationManager->getLocation($hotel->getLocation());

                $hotelData["location"] = $location["location"];

            } catch (ApiException $exception) {
                $hotelData['location'] = [];
            }

            $data['hotels'][] = $hotelData;
        }
        return $data;
    }

}