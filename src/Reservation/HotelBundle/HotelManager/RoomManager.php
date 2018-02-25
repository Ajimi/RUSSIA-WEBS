<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 2:33 PM
 */

namespace Reservation\HotelBundle\HotelManager;


use AppBundle\Exception\ApiException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\Entity\Hotel;
use Reservation\HotelBundle\Entity\Room;

/**
 * Class RoomManager
 * @package Reservation\HotelBundle\HotelManager
 */
class RoomManager extends Manager
{
    private $entityManager;
    private $repository;

    /**
     * RoomManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository();
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository("HotelBundle:Room");
    }

    /**
     * @return array
     * @throws ApiException
     * @internal param Room $room
     */
    public function getList()
    {
        $rooms = $this->repository->findAll();
        $this->isEmpty($rooms, "Empty list of room");
        return $this->serializer($rooms);
    }

    /**
     * @param $rooms
     * @return array
     */
    private function serializer($rooms): array
    {
        $data = array('rooms' => array());
        foreach ($rooms as $room) {
            $data['rooms'][] = $this->serialize($room);
        }
        return $data;
    }

    /**
     * @param Room $room
     * @return array
     */
    public function serialize(Room $room)
    {
        return array(
            'room_id' => $room->getId(),
            'type' => $room->getType(),
            'size' => $room->getSize(),
            'price' => $room->getPrice(),
            'description' => $room->getDescription()
        );
    }

    /**
     * @param Room|null $room
     * @return array
     */
    public function getRoom(Room $room = null): array
    {
        $this->isEmpty($room);
        $data = array('room' => array());
        return $data [] = $this->serialize($room);
    }

    /**
     * @param Hotel|null $hotel
     * @return array
     */
    public function getHotelRooms(Hotel $hotel = null): array
    {
        $this->isEmpty($hotel, "Hotel don't exist");

        $rooms = $this->repository->findByHotel($hotel);
        $data = array('rooms' => array());
        if (!empty($rooms) || $rooms)
            $data = $this->serializer($rooms);

        return $data;
    }


}