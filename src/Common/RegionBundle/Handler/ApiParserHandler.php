<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/14/2018
 * Time: 12:17 PM
 */

namespace Common\RegionBundle\Handler;


use Common\RegionBundle\Entity\Category;
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
     * Create a region from city name
     *
     * @param string $name
     * @return Region|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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

        // TODO ; ADD LOCATION & ADD Address
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createPlace($placeItem, Region $region): Place
    {
        $place = Place::fromJson($placeItem, $region);
        $repo = $this->getRepository('RegionBundle:Place');

        $placeRepo = $repo->findOneBy(['name' => $place->getName()]);
        if ($placeRepo) {
            return $placeRepo;
        }

        $repoCategory = $this->getRepository('RegionBundle:Category');

        $category = $repoCategory->findOneBy(['iconType' => $placeItem['category']['icon_type']]);
        if (!$category) {
            /** @var Category $category */
            $category = Category::fromJson($placeItem['category']);
        }


        // Add a category for place
        $place->setCategory($category);

        $this->manager->persist($place);
        $this->manager->flush();

        return $place;

    }
}