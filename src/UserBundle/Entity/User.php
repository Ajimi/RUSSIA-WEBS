<?php

namespace UserBundle\Entity;

use Common\BookingBundle\Entity\Booking;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $stripeCustomerId;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @ORM\OneToMany(targetEntity="News\NewsBundle\Entity\Article", mappedBy="author")
     */
    private $articles;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;


    /**
     * @ORM\OneToMany(
     *     targetEntity="Common\BookingBundle\Entity\Booking",
     *     mappedBy="user"
     * )
     * @ORM\JoinColumn(nullable=true)
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

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }



    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getStripeCustomerId()
    {
        return $this->stripeCustomerId;
    }

    /**
     * @param mixed $stripeCustomerId
     */
    public function setStripeCustomerId($stripeCustomerId)
    {
        $this->stripeCustomerId = $stripeCustomerId;
    }


}