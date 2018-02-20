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

}