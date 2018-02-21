<?php

namespace Match\MatchBundle\Model;

use Match\MatchBundle\Entity\Statistics;

/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 18/02/2018
 * Time: 17:35
 */
class StatisticDataFormat
{

    /** @var  TeamStatistics */
    private $team1Statistics;

    /** @var  TeamStatistics */
    private $team2Statistics;

    public function __construct()
    {
    }

    /**
     * @return TeamStatistics
     */
    public function getTeam1Statistics():?TeamStatistics
    {
        return $this->team1Statistics;
    }

    /**
     * @param TeamStatistics $team1Statistics
     */
    public function setTeam1Statistics(TeamStatistics $team1Statistics)
    {
        $this->team1Statistics = $team1Statistics;
    }

    /**
     * @return TeamStatistics
     */
    public function getTeam2Statistics():?TeamStatistics
    {
        return $this->team2Statistics;
    }

    /**
     * @param TeamStatistics $team2Statistics
     */
    public function setTeam2Statistics(TeamStatistics $team2Statistics)
    {
        $this->team2Statistics = $team2Statistics;
    }


    /**
     * @param Statistics $statistic
     */
    public function dataFormat(Statistics $statistic, $teamNumber)
    {
        $teamStatistics = new TeamStatistics();
        $teamStatistics->setName($statistic->getTeam()->getName());
        $teamStatistics->setShots($statistic->getShots());

        if ($teamNumber == 1) {
            $this->team1Statistics = $teamStatistics;
        } else {
            $this->team2Statisctics = $teamStatistics;
        }
    }


}