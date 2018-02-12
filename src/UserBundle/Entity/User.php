<?php

namespace UserBundle\Entity;

use Common\BookingBundle\Entity\Booking;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Common\BookingBundle\Entity\Booking",
     *     mappedBy="user",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    private $bookings;

    public function __construct()
    {
        parent::__construct();
        $this->bookings = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function addBooking(Booking $booking)
    {
        if ($this->bookings->contains($booking)) {
            return;
        }

        $this->bookings[] = $booking;
        // needed to update the owning side of the relationship!
        $booking->setUser($this);
    }

    public function removeBooking(Booking $booking)
    {
        if (!$this->bookings->contains($booking)) {
            return;
        }

        $this->bookings->removeElement($booking);
        // needed to update the owning side of the relationship!
        $booking->setUser(null);
    }

    /**
     * @return ArrayCollection|Booking[]
     */
    public function getBookings()
    {
        return $this->bookings;
    }


}