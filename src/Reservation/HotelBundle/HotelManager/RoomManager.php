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

class RoomManager extends Manager
{
    private $entityManager;
    private $repository;

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
        $this->throwApiException($rooms, "Empty list of room");
        $data = $this->roomsSerialization($rooms);

        return $data;
    }

    /**
     * @param $rooms
     * @return array
     */
    private function roomsSerialization($rooms): array
    {
        $data = array('rooms' => array());
        foreach ($rooms as $room) {
            $data['rooms'][] = $this->serializeRoom($room);
        }
        return $data;
    }

    /**
     * @param Room $room
     * @return array
     */
    public function serializeRoom(Room $room)
    {
        return array(
            'room_id' => $room->getId(),
            'type' => $room->getType(),
            'size' => $room->getSize(),
            'price' => $room->getPrice(),
            'description' => $room->getDescription()
        );
    }

    public function getRoom(Room $room = null)
    {
        $this->throwApiException($room);
        $data = array('room' => array());
        return $data [] = $this->serializeRoom($room);
    }

    public function getHotelRooms(Hotel $hotel = null)
    {
        $this->throwApiException($hotel, "Hotel don't exist");

        $rooms = $this->repository->findByHotel($hotel);
        $data = array('rooms' => array());
        if (!empty($rooms) || $rooms)
            $data = $this->roomsSerialization($rooms);

        return $data;
    }


}