<?php

namespace Common\RegionBundle\Entity;

use Common\LocationBundle\Entity\Location;
use Doctrine\ORM\Mapping as ORM;

/**
 * Place
 *
 * @ORM\Table(name="place")
 * @ORM\Entity(repositoryClass="Common\RegionBundle\Repository\PlaceRepository")
 */
class Place
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
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="string", length=255, nullable=true)
     */
    private $information;

    /**
     * @var Region
     * @ORM\ManyToOne(targetEntity="Common\RegionBundle\Entity\Region", inversedBy="places")
     */
    private $region;

    /**
     * @var string
     * @ORM\Column(name="preview_text", type="text")
     */
    private $previewText;

    /**
     * @var string
     * @ORM\Column(name="preview_picture", type="text")
     */
    private $previewPicture;

    /**
     * @var string
     * @ORM\Column(name="working_time", type="string", nullable=true)
     */
    private $workingTime;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="site_url", type="string")
     */
    private $siteUrl;

    /**
     * @var \Common\RegionBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Common\RegionBundle\Entity\Category" , cascade={"persist"})
     */
    private $category;

    /**
     * @var Location|null
     *
     * @ORM\OneToOne(targetEntity="Common\LocationBundle\Entity\Location", cascade={"persist"})
     */
    private $location;


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
     * @return Place
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set information
     *
     * @param string $information
     *
     * @return Place
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * @return Region
     */
    public function getRegion(): Region
    {
        return $this->region;
    }

    /**
     * @param Region $region
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getPreviewText(): string
    {
        return $this->previewText;
    }

    /**
     * @param string $previewText
     */
    public function setPreviewText(string $previewText)
    {
        $this->previewText = $previewText;
    }

    /**
     * @return string
     */
    public function getPreviewPicture(): string
    {
        return $this->previewPicture;
    }

    /**
     * @param string $previewPicture
     */
    public function setPreviewPicture(string $previewPicture)
    {
        $this->previewPicture = $previewPicture;
    }

    /**
     * @return string
     */
    public function getWorkingTime(): string
    {
        return $this->workingTime;
    }

    /**
     * @param string $workingTime
     */
    public function setWorkingTime(string $workingTime)
    {
        $this->workingTime = $workingTime;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * @param string $siteUrl
     */
    public function setSiteUrl(string $siteUrl)
    {
        $this->siteUrl = $siteUrl;
    }

    /**
     * @return \Common\RegionBundle\Entity\Category
     */
    public function getCategory(): \Common\RegionBundle\Entity\Category
    {
        return $this->category;
    }

    /**
     * @param \Common\RegionBundle\Entity\Category $category
     */
    public function setCategory(\Common\RegionBundle\Entity\Category $category)
    {
        $this->category = $category;
    }


    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

    /**
     * @param array $item
     * @param Region $region
     * @return Place
     */
    public static function fromJson($item, Region $region): Place
    {
        /** @var Place $place */
        $place = new Place();

        $place->setName($item['name']);
        $place->setType($item['type']);
        $place->setPreviewText($item['preview_text']);
        $place->setInformation($item['detail_text']);
        $place->setPreviewPicture($item['preview_picture']);
        $place->setRegion($region);
        $place->setPhone($item['phone']);
        $place->setSiteUrl($item['site_url']);

        $location = Location::fromJson($item, $region);
        $place->setLocation($location);
        // TODO : setLocation Association
        return $place;
    }
}

