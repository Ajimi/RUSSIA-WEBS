<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 6:01 PM
 */

namespace Common\LocationBundle\Manager;


use Common\LocationBundle\Entity\Location;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\HotelManager\HotelManager;
use Reservation\HotelBundle\HotelManager\Manager;

class LocationManager extends Manager
{
    private $entityManager;
    private $repository;


    /**
     * LocationManager constructor.
     * @param EntityManager $entityManager
     * @param HotelManager $hotelManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("LocationBundle:Location");
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Common\LocationBundle\Repository\LocationRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }


    /**
     * Returns All Locations
     * @return array
     */
    public function getList()
    {
        $locations = $this->repository->findAll();
        $this->throwApiException($locations, "Empty list of location");
        $data = $this->locationSerialization($locations);

        return $data;
    }

    /**
     * @param Location|null $location
     * @return array
     */
    public function getLocation(Location $location = null)
    {
        $this->throwApiException($location, "Location Object not found");
        $data = array('location' => array());
        $data ['location'] = $this->serializeLocation($location);
        return $data;
    }


    /**
     * @param $locations
     * @return array
     */
    private function locationSerialization($locations): array
    {
        $data = array('locations' => array());
        foreach ($locations as $location) {
            $data['locations'][] = $this->serializeLocation($location);
        }
        return $data;
    }

    /**
     * @param Location $location
     * @return array
     */
    private function serializeLocation(Location $location)
    {
        return array(
            "id" => $location->getId(),
            "country" => $location->getAddress()->getCountry(),
            "city" => $location->getAddress()->getCity(),
            "state" => $location->getAddress()->getState(),
            "street1" => $location->getAddress()->getStreet1(),
            "street2" => $location->getAddress()->getStreet2(),
            "postalcode" => $location->getAddress()->getPostalcode(),
            "longitude" => $location->getGeoCode()->getLongitude(),
            "latitude" => $location->getGeoCode()->getLatitude(),
        );
    }

}