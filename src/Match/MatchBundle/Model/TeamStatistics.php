<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 18/02/2018
 * Time: 17:39
 */

namespace Match\MatchBundle\Model;


use Match\MatchBundle\Entity\Statistics;

class TeamStatistics
{

    private $matchId;
    private $teamId;
    private $match;
    private $name;
    private $shots;

    public function __construct()
    {
    }

    public static function dataFormat(Statistics $statistics)
    {
        $team = new self();
        $team->setName($statistics->getTeam()->getName());
        $team->setShots($statistics->getShots());
        $team->setMatch($statistics->getMatch()->getLevel());
        $team->setMatchId($statistics->getMatch()->getId());
        $team->setTeamId($statistics->getTeam()->getId());

        return $team;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getShots()
    {
        return $this->shots;
    }

    /**
     * @param mixed $shots
     */
    public function setShots($shots)
    {
        $this->shots = $shots;
    }


    /**
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param mixed $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * @return mixed
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * @param mixed $matchId
     */
    public function setMatchId($matchId)
    {
        $this->matchId = $matchId;
    }

    /**
     * @return mixed
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @param mixed $teamId
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }
}