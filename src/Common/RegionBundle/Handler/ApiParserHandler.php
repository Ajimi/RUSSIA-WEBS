<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/14/2018
 * Time: 12:17 PM
 */

namespace Common\RegionBundle\Handler;


use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Entity\Region;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class ApiParserHandler
{
    /**
     * @var EntityManager
     */
    private $manager;

    public function __construct(EntityManager $manager)
    {

        $this->manager = $manager;
    }

    /**
     * @param string $name
     * @return Region|null
     */
    public function createRegion(string $name): ?Region
    {
        if (empty($name))
            return null;
        $repo = $this->getRepository('RegionBundle:Region');

        $region = $repo->findOneBy(['name' => $name]);
        if ($region) {
            return $region;
        }

        $region = new Region();
        $region->setName($name);
        $this->manager->persist($region);
        $this->manager->flush();

        return $region;
    }

    /**
     * @param string $name
     * @return EntityRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->manager->getRepository($name);
    }

    /**
     * @param array $placeItem
     * @param Region $region
     * @return Place
     */
    public function createPlace($placeItem, Region $region): Place
    {
        $place = Place::fromJson($placeItem, $region);
        $repo = $this->getRepository('RegionBundle:Place');

        $placeRepo = $repo->findOneBy(['name' => $place->getName()]);
        if ($placeRepo) {
            return $placeRepo;
        }

        $this->manager->persist($place);
        $this->manager->flush();

        return $place;

    }
}