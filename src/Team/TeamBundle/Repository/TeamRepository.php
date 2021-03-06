<?php

namespace Team\TeamBundle\Repository;

/**
 * TeamRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TeamRepository extends \Doctrine\ORM\EntityRepository
{
    public function updateTeamGoalIn($team,$goals)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("Update TeamBundle:Team t Set t.goalIn= t.goalIn+ :goals where t.id=:id");
        $query->setParameter('goals' , $goals)->setParameter('id',$team);
        $query->execute();
    }
    public function updateTeamGoalScored($team,$goals)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("Update TeamBundle:Team t Set t.goalScored= t.goalScored + :goals where t.id=:id");
        $query->setParameter('goals' , $goals)->setParameter('id',$team);
        $query->execute();
    }

    public function updateTeamWin($team)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("Update TeamBundle:Team t Set t.matchWon= t.matchWon + 1 where t.id=:id");
        $query->setParameter('id',$team);
        $query->execute();
    }

    public function updateTeamLoss($team)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("Update TeamBundle:Team t Set t.matchLost= t.matchLost + 1 where t.id=:id");
        $query->setParameter('id',$team);
        $query->execute();
    }

    public function updateTeamDraw($team)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("Update TeamBundle:Team t Set t.matchDraw= t.matchDraw + 1 where t.id=:id");
        $query->setParameter('id',$team);
        $query->execute();
    }
}
