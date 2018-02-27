<?php

namespace Player\PlayerBundle\Repository;

/**
 * SkillRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkillRepository extends \Doctrine\ORM\EntityRepository
{
    public function findbyPlayer($id)
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.player= :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $qb->execute();
    }
}
