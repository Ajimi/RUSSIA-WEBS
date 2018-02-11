<?php

namespace Reservation\HotelBundle\Entity;

use Common\LocationBundle\Entity\Location;
use Common\RegionBundle\Entity\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * One Hotel has One Hotel.
     * @var Location
     *
     * @ORM\OneToOne(targetEntity="Common\LocationBundle\Entity\Location", inversedBy="hotel")
     * @ORM\JoinColumn(name="location_id", nullable=true, referencedColumnName="id")
     */
    private $location;


    /**
     * @var Region
     *
     * @ORM\ManyToOne(targetEntity="Common\RegionBundle\Entity\Region", inversedBy="hotels")
     * @ORM\JoinColumn(name="region_id", nullable=true, referencedColumnName="id")
     *
     */
    private $region;


    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * TODO : Add Images
     */
    private $hotelImages;

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
     *
     * @return $this
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Add room
     *
     * @param Room $room
     *
     * @return Hotel
     */
    public function addRoom(Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param Room $room
     */
    public function removeRoom(Room $room)
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return Collection|Room[]
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set region
     *
     * @param Region $region
     *
     * @return Hotel
     */
    public function setRegion(Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Hotel
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
