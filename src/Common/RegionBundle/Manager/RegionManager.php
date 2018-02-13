<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 6:48 PM
 */

namespace Common\RegionBundle\Manager;


use Common\LocationBundle\Manager\LocationManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\HotelManager\HotelManager;
use Reservation\HotelBundle\HotelManager\Manager;

/**
 * Class RegionManager
 * @package Common\RegionBundle\Manager
 */
class RegionManager extends Manager
{

    private $entityManager;
    private $repository;
    /**
     * @var HotelManager
     */
    private $hotelManager;

    /**
     * RegionManager constructor.
     * @param EntityManager $entityManager
     * @param HotelManager $hotelManager
     */
    public function __construct(EntityManager $entityManager, HotelManager $hotelManager, LocationManager $location)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("RegionBundle:Region");
        $this->hotelManager = $hotelManager;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }

    /**
     *
     */
    public function getList()
    {
        $rooms = $this->repository->findAll();
        $this->isEmpty($rooms, "Empty list of room");
        return $this->serializer($rooms);
    }


    /**
     * @param $rooms
     */
    private function serializer($rooms)
    {

    }
}