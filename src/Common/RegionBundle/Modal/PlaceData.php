<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/27/2018
 * Time: 9:58 AM
 */

namespace Common\RegionBundle\Modal;


use Common\RegionBundle\Entity\Category;
use Common\RegionBundle\Entity\Region;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class PlaceData
 * @package Common\RegionBundle\Modal
 */
class PlaceData
{
    private $name;
    private $information;
    private $previewText;
    private $previewPicture;
    private $phone;
    private $siteUrl;
    private $longitude;

    private $latitude;
    /** @var File $file */
    private $file;
    /** @var Region $region */
    private $region;
    /** @var Category $category */
    private $category;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return PlaceData
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param mixed $information
     * @return PlaceData
     */
    public function setInformation($information)
    {
        $this->information = $information;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviewText()
    {
        return $this->previewText;
    }

    /**
     * @param mixed $previewText
     * @return PlaceData
     */
    public function setPreviewText($previewText)
    {
        $this->previewText = $previewText;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviewPicture()
    {
        return $this->previewPicture;
    }

    /**
     * @param mixed $previewPicture
     * @return PlaceData
     */
    public function setPreviewPicture($previewPicture)
    {
        $this->previewPicture = $previewPicture;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return PlaceData
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * @param mixed $siteUrl
     * @return PlaceData
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;
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
     * @return PlaceData
     */
    public function setRegion(Region $region): PlaceData
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     * @return PlaceData
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     * @return PlaceData
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File $file
     * @return PlaceData
     */
    public function setFile(File $file): PlaceData
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return PlaceData
     */
    public function setCategory(Category $category): PlaceData
    {
        $this->category = $category;
        return $this;
    }


}