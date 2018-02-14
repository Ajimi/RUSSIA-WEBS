<?php

namespace Reservation\TicketBundle\Entity;

use Common\BookingBundle\Entity\Booking;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Reservation\TicketBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * onetomany
     */
    private $match;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=10, scale=10)
     */
    private $price;

    /**
     * @var ArrayCollection | Booking[]
     * @ORM\OneToMany(targetEntity="Common\BookingBundle\Entity\Booking", mappedBy="ticket")
     */
    private $bookings;


    /**
     * Ticket constructor.
     */
    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice(string $price)
    {
        $this->price = $price;
        return $this;
    }
}

