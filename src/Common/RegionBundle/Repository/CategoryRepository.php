<?php

namespace Common\RegionBundle\Repository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{

    public function getBuilder()
    {
        return $this->createQueryBuilder("c");
    }

}
