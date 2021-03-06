<?php

namespace Group\GroupBundle\Repository;

/**
 * GroupeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GroupeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getGroupByTeam($team)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
          Select g
          From GroupBundle:Groupe g 
          where g.team1= :team 
          or g.team2= :team
          or g.team3= :team
          or g.team4= :team
    ");
        $query->setParameter('team', $team);
        return $query->getOneOrNullResult();
    }
}
