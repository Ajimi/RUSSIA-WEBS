<?php

namespace Common\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @return \General\LocationBundle\Entity\GeoCode
     */
    public function getGeoCode()
    {
        return $this->geoCode;
    }

    /**
     * Set geoCode
     *
     * @param \General\LocationBundle\Entity\GeoCode $geoCode
     *
     * @return Location
     */
    public function setGeoCode(\General\LocationBundle\Entity\GeoCode $geoCode = null)
    {
        $this->geoCode = $geoCode;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Reservation\HotelBundle\Entity\Hotel
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
    public function setHotel(\Reservation\HotelBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }
}
