<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/27/2018
 * Time: 9:57 AM
 */

namespace Common\RegionBundle\Transformer;


use Common\LocationBundle\Entity\GeoCode;
use Common\LocationBundle\Entity\Location;
use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Modal\PlaceData;
use Proxies\__CG__\Common\LocationBundle\Entity\Address;

class PlaceDataTransformer
{

    /**
     * @param PlaceData $placeData
     * @param Place|null $place
     * @return Place|null
     */
    public static function transform(PlaceData $placeData, Place $place = null)
    {
        if ($place == null)
            $place = new Place();

        // TODO : Sanity check for nullability
        // if(is_null())
        $place->setName($placeData->getName());
        $place->setInformation($placeData->getInformation());
        $place->setPreviewText($placeData->getPreviewText());
        $place->setPreviewPicture($placeData->getPreviewPicture());
        $place->setPhone($placeData->getPhone());
        $place->setSiteUrl($placeData->getSiteUrl());
        $place->setRegion($placeData->getRegion());
        $place->setCategory($placeData->getCategory());

        $geo = new GeoCode();

        $geo->setLongitude($placeData->getLongitude());
        $geo->setLatitude($placeData->getLatitude());

        $address = new Address();
        $address->setCity($placeData->getName());
        $address->setState($placeData->getName());

        $location = new Location();

        $location->setGeoCode($geo);
        $location->setAddress($address);

        $place->setLocation($location);

        return $place;
    }


    /**
     * @param Place $place
     * @return PlaceData
     */
    public static function reverseTransform(Place $place)
    {

        // TODO : Sanity check for nullability
        // if(is_null())
        $placeData = new PlaceData();

        if (($location = $place->getLocation()) && $geocode = $location->getGeoCode()) {
            $placeData->setLatitude($location->getGeoCode()->getLatitude());
            $placeData->setLongitude($location->getGeoCode()->getLongitude());
        } else {
            $placeData->setLatitude('58.5906365');
            $placeData->setLongitude('56.2851078');
        }
        $placeData->setName($place->getName());
        $placeData->setInformation($place->getInformation());
        $placeData->setPreviewText($place->getPreviewText());
        $placeData->setPreviewPicture($place->getPreviewPicture());
        $placeData->setPhone($place->getPhone());
        $placeData->setSiteUrl($place->getSiteUrl());
        $placeData->setRegion($place->getRegion());
        $placeData->setCategory($place->getCategory());

        return $placeData;

    }
}