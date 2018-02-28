<?php

namespace Match\MatchBundle\Repository;

/**
 * MatchRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatchRepository extends \Doctrine\ORM\EntityRepository
{
    public function searchDQL($name)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT t FROM MatchBundle:MATCH t 
                                WHERE t.team1 OR t.team2  LIKE :name")
            ->setParameter('name', '%' . $name . '%');
        return $query->getResult();

    }

    public function findAllBy($criteria)
    {
        $qb = $this->createQueryBuilder('m')
            ->andWhere('m.id in (:criteria)')
            ->setParameter('criteria', $criteria);

        return $qb->getQuery()->getResult();
    }

    public function getQueryBuilder()
    {
        return $this->createQueryBuilder("m");
    }
}
