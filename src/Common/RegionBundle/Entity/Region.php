<?php

namespace Common\RegionBundle\Entity;

use Common\LocationBundle\Entity\Location;
use Common\UploadBundle\Annotation\Uploadable;
use Common\UploadBundle\Annotation\UploadableField;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Reservation\HotelBundle\Entity\Hotel;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="Common\RegionBundle\Repository\RegionRepository")
 * @Uploadable()
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
     * One RNegion has Many Hotels.
     * @ORM\OneToMany(targetEntity="Reservation\HotelBundle\Entity\Hotel", mappedBy="region")
     */
    private $hotels;

    /**
     * One Region has Many Hotels.
     * @ORM\OneToMany(targetEntity="Common\RegionBundle\Entity\Place", mappedBy="region", cascade={"remove"})
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $places;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string $image
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;

    /**
     * @var File|null $file
     * @UploadableField(filename="image", path="uploads/region")
     */
    private $file;

    /**
     * @var string
     * @ORM\Column(name="youtube_video" , type="string" ,nullable=true)
     */
    private $youtubeVideo;
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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     */
    public function setFile(?File $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getYoutubeVideo()
    {
        return $this->youtubeVideo;
    }

    /**
     * @param string $youtubeVideo
     */
    public function setYoutubeVideo($youtubeVideo)
    {
        $this->youtubeVideo = $youtubeVideo;
    }
}
