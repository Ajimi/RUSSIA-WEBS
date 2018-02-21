<?php

namespace Common\RegionBundle\Entity;

use Common\LocationBundle\Entity\Location;
use Common\UploadBundle\Annotation\UploadableField;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Reservation\HotelBundle\Entity\Hotel;


/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="Common\RegionBundle\Repository\RegionRepository")
 */
class Region
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
     * @var Location
     *
     * @ORM\OneToOne(targetEntity="Common\LocationBundle\Entity\Location", inversedBy="region", cascade={"persist"})
     */
    private $location;

    /**
     * One Region has Many Hotels.
     * @ORM\OneToMany(targetEntity="Reservation\HotelBundle\Entity\Hotel", mappedBy="region")
     */
    private $hotels;

    /**
     * One Region has Many Hotels.
     * @ORM\OneToMany(targetEntity="Common\RegionBundle\Entity\Place", mappedBy="region")
     */
    private $places;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * Region constructor.
     */
    public function __construct()
    {
        $this->hotels = new ArrayCollection();
        $this->places = new ArrayCollection();
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
     * @return Region
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add hotel
     *
     * @param Hotel $hotel
     *
     * @return Region
     */
    public function addHotel(Hotel $hotel)
    {
        $this->hotels[] = $hotel;

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param Hotel $hotel
     */
    public function removeHotel(Hotel $hotel)
    {
        $this->hotels->removeElement($hotel);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection|Hotel[]
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * @param Place $place
     */
    public function addPlace(Place $place)
    {
        if ($this->places->contains($place)) {
            return;
        }

        $this->places[] = $place;
        // needed to update the owning side of the relationship!
        $place->setRegion($this);
    }

    /**
     * @param Place $place
     */
    public function removePlace(Place $place)
    {
        if (!$this->places->contains($place)) {
            return;
        }

        $this->places->removeElement($place);
        // needed to update the owning side of the relationship!
        $place->setRegion(null);
    }

    /**
     * @return ArrayCollection|Place[]
     */
    public function getPlaces()
    {
        return $this->places;
    }
    /**
     * Set location
     *
     * @param \Common\LocationBundle\Entity\Location $location
     *
     * @return Region
     */
    public function setLocation(\Common\LocationBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \Common\LocationBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Region
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
