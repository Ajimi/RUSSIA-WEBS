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
     * @var integer
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\OneToOne(targetEntity="Reservation\TicketBundle\Entity\Matche", inversedBy="ticket")
     */
    private $matche;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=4, scale=2)
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

    /**
     * @return Matche
     */
    public function getMatch(): Matche
    {
        return $this->match;
    }

    /**
     * @param mixed $matche
     */
    public function setMatch($matche)
    {
        $this->match = $matche;
    }

    /**
     * Add booking
     *
     * @param \Common\BookingBundle\Entity\Booking $booking
     *
     * @return Ticket
     */
    public function addBooking(\Common\BookingBundle\Entity\Booking $booking)
    {
        $this->bookings[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \Common\BookingBundle\Entity\Booking $booking
     */
    public function removeBooking(\Common\BookingBundle\Entity\Booking $booking)
    {
        $this->bookings->removeElement($booking);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getMatche()
    {
        return $this->matche;
    }

    /**
     * @param mixed $matche
     */
    public function setMatche($matche)
    {
        $this->matche = $matche;
    }
}
