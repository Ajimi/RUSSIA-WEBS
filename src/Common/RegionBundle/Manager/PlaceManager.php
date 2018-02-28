<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/28/2018
 * Time: 10:53 AM
 */

namespace Common\RegionBundle\Manager;


use AppBundle\Exception\ApiException;
use Common\LocationBundle\Manager\LocationManager;
use Common\RegionBundle\Entity\Place;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Reservation\HotelBundle\HotelManager\Manager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlaceManager
 * @package Common\RegionBundle\Manager
 */
class PlaceManager extends Manager
{
    private $repository;
    private $entityManager;
    /**
     * @var LocationManager $locationManager
     */
    private $locationManager;

    /**
     * PlaceManger constructor.
     * @param EntityManager $entityManager
     * @param LocationManager $location
     */
    public function __construct(EntityManager $entityManager, LocationManager $location)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("RegionBundle:Place");
        $this->locationManager = $location;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }

    /**
     * @return array
     * @throws ApiException
     */
    public function getList()
    {
        $places = $this->repository->findAll();
        $this->isEmpty($places, "Empty list of places");
        return $this->serializer($places);
    }

    /**
     * @param array|Place[] $places
     * @return array
     * @internal param $
     */
    public function serializer($places)
    {
        $data = array('places' => array());
        foreach ($places as $place) {
            $placeData = $this->serialize($place);

            try {
                $location = $this->locationManager->getLocation($place->getLocation());

                $placeData["location"] = $location["location"];

            } catch (ApiException $exception) {
                $placeData['location'] = [];
            }

            $data['places'][] = $placeData;
        }
        return $data;
    }

    /**
     * @param Place $place
     * @return array
     * @internal param $places
     */
    public function serialize(Place $place)
    {
        return array(
            "id" => $place->getId(),
            "name" => $place->getName(),
            "category" => $place->getCategory(),
            "phone" => $place->getPhone(),
            "site_url" => $place->getSiteUrl(),
            "preview_picture" => $place->getPreviewPicture(),
            "information" => $place->getInformation(),
            "type" => $place->getType(),
        );
    }

    /**
     * @param $place
     * @return array
     * @throws ApiException
     */
    public function getPlace($place): array
    {
        $this->isEmpty($place);
        $data = array('place' => array());
        $data ['place'] = $this->serializer(array($place))['places'];
        return $data;
    }


}