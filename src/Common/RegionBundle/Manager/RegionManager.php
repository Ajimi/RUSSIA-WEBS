<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 6:48 PM
 */

namespace Common\RegionBundle\Manager;


use Common\LocationBundle\Manager\LocationManager;
use Common\RegionBundle\Entity\Region;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\Entity\Hotel;
use Reservation\HotelBundle\HotelManager\HotelManager;
use Reservation\HotelBundle\HotelManager\Manager;

/**
 * Class RegionManager
 * @package Common\RegionBundle\Manager
 */
class RegionManager extends Manager
{

    private $entityManager;
    private $repository;
    /**
     * @var HotelManager
     */
    private $hotelManager;
    /**
     * @var LocationManager
     */
    private $location;
    /**
     * @var PlaceManager
     */
    private $placeManager;

    /**
     * RegionManager constructor.
     * @param EntityManager $entityManager
     * @param HotelManager $hotelManager
     * @param LocationManager $location
     * @param PlaceManager $placeManager
     */
    public function __construct(EntityManager $entityManager, HotelManager $hotelManager, LocationManager $location, PlaceManager $placeManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("RegionBundle:Region");
        $this->hotelManager = $hotelManager;
        $this->location = $location;
        $this->placeManager = $placeManager;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }

    /**
     *
     * @throws \AppBundle\Exception\ApiException
     */
    public function getList()
    {
        $regions = $this->repository->findAll();
        $this->isEmpty($regions, "Empty list of region");
        return $this->serializer($regions);
    }


    /**
     * @param Region|null $region
     * @return array
     * @throws \AppBundle\Exception\ApiException
     */
    public function getRegion(Region $region = null): array
    {
        $this->isEmpty($region);
        $data = array('region' => array());
        $data ['region'] = $this->serializer(array($region))['regions'];
        return $data;
    }

    /**
     * @param Region $region
     * @return array
     * @internal param $regions
     */
    private function serialize(Region $region)
    {
        return array(
            "id" => $region->getId(),
            "name" => $region->getName(),
            "slug" => $region->getSlug()
        );
    }

    /**
     * @param array|Region[] $regions
     * @return array
     * @internal param $
     */
    private function serializer($regions)
    {
        $data = array('regions' => array());
        foreach ($regions as $region) {
            $regionData = $this->serialize($region);
            $hotels = $region->getHotels();
            $places = $region->getPlaces();
            $regionData['hotels'] = $this->hotelManager->serializer($hotels)['hotels'];
            $regionData['places'] = $this->placeManager->serializer($places)['places'];
            $data['regions'][] = $regionData;
        }
        return $data;
    }
}