<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/21/2018
 * Time: 1:52 PM
 */

namespace Common\RegionBundle\Transformer;


use Common\LocationBundle\Entity\Address;
use Common\LocationBundle\Entity\GeoCode;
use Common\LocationBundle\Entity\Location;
use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Modal\RegionData;

class RegionDataTransformer
{
    /**
     * @param RegionData $regionData
     * @param null $region
     * @return Region|null
     */
    public static function transform(RegionData $regionData, Region $region = null)
    {
        if ($region == null)
            $region = new Region();
        $region->setName($regionData->getRegionName());
        $region->setFile($regionData->getFile());
        $region->setYoutubeVideo($regionData->getYoutubeVideo());
        $location = new Location();

        $geo = new GeoCode();

        $geo->setLongitude($regionData->getLongitude());
        $geo->setLatitude($regionData->getLatitude());

        $address = new Address();
        $address->setCity($regionData->getRegionName());
        $address->setState($regionData->getRegionName());


        $location->setGeoCode($geo);
        $location->setAddress($address);

        $region->setLocation($location);

        return $region;
    }

    /**
     * @param Region $region
     * @return RegionData
     */
    public static function reverseTransform(Region $region)
    {

        $regionData = new RegionData();

        if (($location = $region->getLocation()) && $geocode = $location->getGeoCode()) {
            $regionData->setLatitude($location->getGeoCode()->getLatitude());
            $regionData->setLongitude($location->getGeoCode()->getLongitude());
        } else {
            $regionData->setLatitude('58.5906365');
            $regionData->setLongitude('56.2851078');
        }
        $regionData->setRegionName($region->getName());
        $regionData->setFile($region->getFile());
        $regionData->setYoutubeVideo($region->getYoutubeVideo());


        return $regionData;
    }
}