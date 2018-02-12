<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 6:55 PM
 */

namespace Common\BookingBundle\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\HotelManager\Manager;

class BillManager extends Manager
{

    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("BookingBundle:Bill");
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }
}