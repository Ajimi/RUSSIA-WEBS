<?php

namespace Reservation\HotelBundle\Entity;

use AppBundle\Exception\ApiThrowable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="Reservation\HotelBundle\Repository\RoomRepository")
 */
class Room
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="decimal", precision=10, scale=0)
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(name="bedNumber", type="integer")
     */
    private $bedNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="availability", type="boolean")
     */
    private $available;

    /**
     * Many Rooms has one Hotel.
     * @ORM\ManyToOne(targetEntity="Reservation\HotelBundle\Entity\Hotel", inversedBy="rooms")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * TODO : Add Images
     */
    private $roomImages;


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
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Room
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return Room
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get bedNumber
     *
     * @return int
     */
    public function getBedNumber()
    {
        return $this->bedNumber;
    }

    /**
     * Set bedNumber
     *
     * @param integer $bedNumber
     *
     * @return Room
     */
    public function setBedNumber($bedNumber)
    {
        $this->bedNumber = $bedNumber;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Room
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * @param Hotel $hotel
     * @return $this
     */
    public function setHotel(Hotel $hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @param bool $available
     */
    public function setAvailable(bool $available)
    {
        $this->available = $available;
    }


}
