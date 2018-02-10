<?php

namespace Reservation\HotelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Common\LocationBundle\Entity\Location;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity(repositoryClass="Reservation\HotelBundle\Repository\HotelRepository")
 */
class Hotel
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(name="availableRooms", type="integer")
     */
    private $availableRooms;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;

    /**
     * @var int
     *
     * @ORM\Column(name="stars", type="integer")
     */
    private $stars;

    /**
     * One Location has One GeoCode.
     * @ORM\OneToOne(targetEntity="Common\LocationBundle\Entity\Location", mappedBy="location")
     */
    private $location;


    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Room", mappedBy="hotel")
     */
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Hotel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get availableRooms
     *
     * @return int
     */
    public function getAvailableRooms()
    {
        return $this->availableRooms;
    }

    /**
     * Set availableRooms
     *
     * @param integer $availableRooms
     *
     * @return Hotel
     */
    public function setAvailableRooms($availableRooms)
    {
        $this->availableRooms = $availableRooms;

        return $this;
    }

    /**
     * Get rate
     *
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return Hotel
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get stars
     *
     * @return int
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * Set stars
     *
     * @param integer $stars
     *
     * @return Hotel
     */
    public function setStars($stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Add room
     *
     * @param \Reservation\HotelBundle\Entity\Room $room
     *
     * @return Hotel
     */
    public function addRoom(\Reservation\HotelBundle\Entity\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \Reservation\HotelBundle\Entity\Room $room
     */
    public function removeRoom(\Reservation\HotelBundle\Entity\Room $room)
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}
