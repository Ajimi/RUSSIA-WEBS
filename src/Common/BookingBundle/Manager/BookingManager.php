<?php

namespace Common\BookingBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\HotelManager\Manager;

/**
 * Class BookingManager
 * @package Common\BookingBundle\Manager
 */
class BookingManager extends Manager
{
    private $entityManager;
    private $repository;

    /**
     * BookingManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("BookingBundle:Booking");
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }
}