<?php

namespace Player\PlayerBundle\Repository;

/**
 * PlayerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerRepository extends \Doctrine\ORM\EntityRepository
{
    //Team_Front_Stat_Functions
    public function goalScoredByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.goalScored)')
            ->getQuery();
        return $query->getSingleScalarResult();

    }

    public function shotsByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.shots)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function shotsOnTargetByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.shotsOnTarget)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function assistsByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.assists)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function foulsByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.fouls)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function cornerByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.cornerKicks)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function penaltyByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.penaltyKicks)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function yellowCardsByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.yellowCard)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function redCardsByTeam($team)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.nationalTeam = :team')
            ->setParameter('team', $team)
            ->select('SUM(p.redCard)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    //Player_Stat_Update
    public function updatePlayerStat($player, $event)
    {
        $em = $this->getEntityManager();

        if ($event == "Goal") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.goalScored= p.goalScored + 1, p.shotsOnTarget= p.shotsOnTarget + 1, p.shots= p.shots + 1 where p.id= :id");
        }
        if ($event == "Shot") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.shots= p.shots + 1 where p.id= :id");
        }
        if ($event == "Shot(On Target)") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.shotsOnTarget= p.shotsOnTarget + 1, p.shots= p.shots + 1 where p.id= :id");
        }
        if ($event == "Assist") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.assists= p.assists + 1,p.passes= p.passes + 1 where p.id= :id");
        }
        if ($event == "Pass") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.passes= p.passes + 1 where p.id= :id");
        }
        if ($event == "Foul") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.fouls= p.fouls + 1 where p.id= :id");
        }
        if ($event == "Corner Kick") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.penaltyKicks= p.penaltyKicks + 1,p.fouls= p.fouls + 1 where p.id= :id");
        }
        if ($event == "Penalty Kick") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.cornerKicks= p.cornerKicks + 1,p.fouls= p.fouls + 1 where p.id= :id");
        }
        if ($event == "Yellow Card") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.yellowCard= p.yellowCard + 1 where p.id= :id");
        }
        if ($event == "Red Card") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.redCard= p.redCard + 1 where p.id= :id");
        }
        $query->setParameter('id', $player);
        $query->execute();
    }


    public function removePlayerStat($player, $event)
    {
        $em = $this->getEntityManager();
        if ($event == "Goal") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.goalScored= p.goalScored - 1, p.shotsOnTarget= p.shotsOnTarget - 1, p.shots= p.shots - 1 where p.id= :id");
            $query->setParameter('id', $player);

        }
        if ($event == "Shot") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.shots= p.shots - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Shot(On Target)") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.shotsOnTarget= p.shotsOnTarget - 1, p.shots= p.shots - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Assist") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.assists= p.assists - 1,p.passes= p.passes - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Pass") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.passes= p.passes - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Foul") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.fouls= p.fouls - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Corner Kick") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.penaltyKicks= p.penaltyKicks - 1,p.fouls= p.fouls - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Penalty Kick") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.cornerKicks= p.cornerKicks - 1,p.fouls= p.fouls - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Yellow Card") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.yellowCard= p.yellowCard - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }
        if ($event == "Red Card") {
            $query = $em->createQuery("Update PlayerBundle:Player p Set p.redCard= p.redCard - 1 where p.id= :id");
            $query->setParameter('id', $player);
            $query->execute();

        }

    }

    public function bestScorer()
    {
        $query = $this->getEntityManager()->createQuery("SELECT p FROM PlayerBundle:Player p ORDER BY p.goalScored DESC")
            ->setMaxResults(1);
        return $query->getResult();
    }
    public function findBestScorer($team)
    {
        $query = $this->getEntityManager()->createQuery("SELECT p FROM PlayerBundle:Player p WHERE p.nationalTeam = :team ORDER BY p.goalScored DESC")
            ->setParameter('team', $team)
            ->setMaxResults(1);
        return $query->getResult();
    }

    public function totalVisits()
    {
        $query = $this->createQueryBuilder('p')
            ->select('SUM(p.visits)')
            ->getQuery();
        return $query->getSingleScalarResult();

    }

    public function addVisit($player)
    {
        $query = $this->getEntityManager()->createQuery("Update PlayerBundle:Player p Set p.visits= p.visits + 1 where p.id= :id")
            ->setParameter('id', $player);
        return $query->execute();
    }

    public function getFamousPlayers()
    {
        $query = $this->getEntityManager()->createQuery("Select p From  PlayerBundle:Player p ORDER BY p.visits DESC")
            ->setMaxResults(4);
        return $query->getResult();
    }
}
