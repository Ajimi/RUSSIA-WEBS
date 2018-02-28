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
     * @ORM\Column(name="preview_picture", type="text", nullable=true)
     */
    private $previewPicture;

    /**
     * @var string
     * @ORM\Column(name="working_time", type="string", nullable=true)
     */
    private $workingTime;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", nullable=true)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="site_url", type="string", nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

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
    public function getRegion(): ?Region
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
    public function getPreviewText(): ?string
    {
        return $this->previewText;
    }

    /**
     * @param string $previewText
     */
    public function setPreviewText($previewText)
    {
        $this->previewText = $previewText;
    }

    /**
     * @return string
     */
    public function getPreviewPicture(): ?string
    {
        return $this->previewPicture;
    }

    /**
     * @param string $previewPicture
     */
    public function setPreviewPicture($previewPicture)
    {
        $this->previewPicture = $previewPicture;
    }

    /**
     * @return string
     */
    public function getWorkingTime(): ?string
    {
        return $this->workingTime;
    }

    /**
     * @param string $workingTime
     */
    public function setWorkingTime($workingTime)
    {
        $this->workingTime = $workingTime;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getSiteUrl(): ?string
    {
        return $this->siteUrl;
    }

    /**
     * @param string $siteUrl
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;
    }

    /**
     * @return \Common\RegionBundle\Entity\Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param \Common\RegionBundle\Entity\Category $category
     */
    public function setCategory(Category $category)
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
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating)
    {
        $this->rating = $rating;
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
        $place->setRating(random_int(1, 5));
        // Completed : get blocks and picture name

        $place->setPreviewPicture(self::getImageUrl($item['preview_picture']));
        $place->setRegion($region);
        $place->setPhone($item['phone']);
        $place->setSiteUrl($item['site_url']);

        $location = Location::fromJson($item, $region);
        $place->setLocation($location);
        // Completed : setLocation Association
        return $place;
    }

    /**
     * @param $pictureUrl
     * @return string
     */
    public static function getImageUrl($pictureUrl): string
    {

        $pictureArray = explode('/', $pictureUrl);

        if ($pictureArray[5] === 'no_img.png') {
            return $pictureUrl;
        }

        $block = $pictureArray[7];
        $pictureFileArray = explode('?', $pictureArray[8]);

        $pictureFileName = $pictureFileArray[0];


        return "http://cdn.welcome2018.com/upload/iblock/$block/$pictureFileName";


    }

    public function __toString()
    {
        return $this->name;
    }

}

