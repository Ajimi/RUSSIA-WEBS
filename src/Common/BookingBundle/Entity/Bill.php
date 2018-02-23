<?php

namespace Common\BookingBundle\Entity;

use Common\BookingBundle\BookingBundle;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table(name="bill")
 * @ORM\Entity(repositoryClass="Common\BookingBundle\Repository\BillRepository")
 */
class Bill
{
    const TYPE_TICKET = 'ticket';
    const TYPE_HOTEL = 'hotel';
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=10)
     */
    private $total;

    /**
     * @var Booking
     * @ORM\OneToOne(targetEntity="Common\BookingBundle\Entity\Booking", mappedBy="bill")
     */
    private $booking;


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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * @param string $total
     * @return $this
     */
    public function setTotal(string $total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return Booking
     */
    public function getBooking(): Booking
    {
        return $this->booking;
    }

    /**
     * @param Booking $booking
     */
    public function setBooking(Booking $booking)
    {
        $this->booking = $booking;
    }


}

