<?php

namespace Common\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Reservation\HotelBundle\Entity\Hotel;
use Reservation\TicketBundle\Entity\Ticket;
use UserBundle\Entity\User;

/**
 * Book
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="Common\BookingBundle\Repository\BookRepository")
 */
class Booking
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
     * @var Bill
     * @ORM\OneToOne(targetEntity="Common\BookingBundle\Entity\Bill" , inversedBy="booking")
     * @ORM\JoinColumn(name="bill_id", nullable=true, referencedColumnName="id")
     */
    private $bill;

    /**
     * @var Hotel
     * @ORM\ManyToOne(targetEntity="Reservation\HotelBundle\Entity\Hotel", inversedBy="booking")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="bookedReservation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var Ticket
     * @ORM\ManyToOne(targetEntity="Reservation\TicketBundle\Entity\Ticket", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ticket;

    /**
     * @return Hotel
     */
    public function getHotel(): Hotel
    {
        return $this->hotel;
    }

    /**
     * @param Hotel $hotel
     */
    public function setHotel(Hotel $hotel)
    {
        $this->hotel = $hotel;
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
     * @return Bill
     */
    public function getBill(): Bill
    {
        return $this->bill;
    }

    /**
     * @param Bill $bill
     */
    public function setBill(Bill $bill)
    {
        $this->bill = $bill;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Ticket
     */
    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    /**
     * @param Ticket $ticket
     */
    public function setTicket(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

}

