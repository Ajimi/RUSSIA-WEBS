<?php

namespace Common\LocationBundle\Entity;

use Common\RegionBundle\Entity\Region;
use Doctrine\ORM\Mapping as ORM;
use Faker\Generator;
use Nelmio\Alice\Instances\Processor\Methods\Faker;
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
     * @var Address
     * @ORM\OneToOne(targetEntity="Common\LocationBundle\Entity\Address", inversedBy="location", cascade={"persist"})
     * @ORM\JoinColumn(name="address_id", nullable=true)
     */
    private $address;


    /**
     * @var GeoCode
     * @ORM\OneToOne(targetEntity="Common\LocationBundle\Entity\GeoCode", inversedBy="location", cascade={"persist"})
     * @ORM\JoinColumn(name="geo_code_id", nullable=true)
     */
    private $geoCode;


    /**
     * @var Hotel
     * @ORM\OneToOne(targetEntity="Reservation\HotelBundle\Entity\Hotel", mappedBy="location")
     */
    private $hotel;


    /**
     * @var Region
     * @ORM\OneToOne(targetEntity="Common\RegionBundle\Entity\Region", mappedBy="location")
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
     * @param Hotel $hotel
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
     * @param Region $region
     *
     * @return Location
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
     * @param $item
     * @param Region $city
     * @return Location
     */
    public static function fromJson($item, Region $city): Location
    {
        $location = new Location();
        $address = new Address();
        $faker = new Generator();
        $geocode = new GeoCode();


        $address->setCity($city->getName());
        $address->setState($city->getName());
//        $address->setPostalcode($faker->postcode);
//        $address->setStreet1($faker->streetAddress);

        $geocodeArray = explode(',', $item['location']);
        $geocode->setLatitude($geocodeArray[0]);
        $geocode->setLongitude($geocodeArray[1]);

        $location->setAddress($address);
        $location->setGeoCode($geocode);
        return $location;
    }

    public function __toString()
    {
        return 'location';
    }
}
