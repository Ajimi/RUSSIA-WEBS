<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 2:33 PM
 */

namespace Reservation\TicketBundle\Manager;


use Common\LocationBundle\Manager\LocationManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\HotelManager\Manager;

class TicketManager extends Manager
{
    private $entityManager;
    private $repository;


    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("TicketBundle:Ticket");
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }
}
