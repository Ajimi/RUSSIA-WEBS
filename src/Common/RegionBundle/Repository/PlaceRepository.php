<?php

namespace Common\RegionBundle\Repository;

/**
 * PlaceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlaceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByRegion($region)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.region = :region')
            ->setParameter('region', $region)
            ->getQuery()
            ->getResult();
        return $qb;
    }

    public function findByCategory($region, $category, $hasPicture = true)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.region = :region')
            ->andWhere('p.category = :category');

        if ($hasPicture) {
            $qb = $qb->andWhere('p.previewText != \'\'')
                ->andWhere('p.previewPicture NOT LIKE \'%no_img.png\' ');
        }
        $qb = $qb->setParameter('region', $region)
            ->setParameter('category', $category)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
        return $qb;
    }

}
