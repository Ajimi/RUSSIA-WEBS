<?php

namespace Common\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Reservation\HotelBundle\Entity\Hotel;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="Common\LocationBundle\Repository\LocationRepository")
 */
class Location
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
     * One Location has One Address.
     * @ORM\OneToOne(targetEntity="Address", mappedBy="location")
     */
    private $address;

    /**
     * One Location has One GeoCode.
     * @ORM\OneToOne(targetEntity="GeoCode", mappedBy="location")
     */
    private $geoCode;


    /**
     * One Location has One Hotel.
     * @ORM\OneToOne(targetEntity="Reservation\HotelBundle\Entity\Hotel", inversedBy="location")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;

    /**
     * One Location has One Hotel.
     * @ORM\OneToOne(targetEntity="Common\RegionBundle\Entity\Region", inversedBy="location")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    private $region;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get geoCode
     *
     * @return GeoCode
     */
    public function getGeoCode()
    {
        return $this->geoCode;
    }

    /**
     * Set geoCode
     *
     * @param GeoCode $geoCode
     *
     * @return Location
     */
    public function setGeoCode(GeoCode $geoCode = null)
    {
        $this->geoCode = $geoCode;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set hotel
     *
     * @param \Reservation\HotelBundle\Entity\Hotel $hotel
     *
     * @return Location
     */
    public function setHotel(Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Set region
     *
     * @param \Common\RegionBundle\Entity\Region $region
     *
     * @return Location
     */
    public function setRegion(\Common\RegionBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Common\RegionBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }
}
