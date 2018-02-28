<?php
/**
 * Created by PhpStorm.
 * User: Moez-PC
 * Date: 23/02/2018
 * Time: 19:14
 */

namespace Group\GroupBundle\Modele;

use Symfony\Component\HttpFoundation\File\File;

class StandingsFormat
{
    public $group;
    public $logo;
    public $teamName;
    public $idTeam;
    public $teamShortcut;
    public $win;
    public $lost;
    public $drow;

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }
    /**
     * @return mixed
     */
    public function getDrow()
    {
        return $this->drow;
    }

    /**
     * @param mixed $drow
     */
    public function setDrow($drow)
    {
        $this->drow = $drow;
    }
    public $points;

    /**
     * StandingsFormat constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getTeamShortcut()
    {
        return $this->teamShortcut;
    }

    /**
     * @param mixed $teamShortcut
     */
    public function setTeamShortcut($teamShortcut)
    {
        $this->teamShortcut = $teamShortcut;
    }

    /**
     * @return File
     */
    public function getLogo():?File
    {
        return $this->logo;
    }

    /**
     * @param File $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * @param mixed $teamName
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
    }

    /**
     * @return mixed
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * @param mixed $win
     */
    public function setWin($win)
    {
        $this->win = $win;
    }

    /**
     * @return mixed
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * @param mixed $lost
     */
    public function setLost($lost)
    {
        $this->lost = $lost;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return mixed
     */
    public function getIdTeam()
    {
        return $this->idTeam;
    }

    /**
     * @param mixed $idTeam
     */
    public function setIdTeam($idTeam)
    {
        $this->idTeam = $idTeam;
    }

    public function dataFormat(\Team\TeamBundle\Entity\Team $team)
    {
        $this->setIdTeam($team->getId());
        $this->setDrow($team->getMatchDraw());
        $this->setLogo($team->getTeamLogo());
        $this->setTeamName($team->getTeamName());
        $this->setTeamShortcut($team->getTeamShortcut());
        $this->setWin($team->getMatchWon());
        $this->setLost($team->getMatchLost());
        $pts = ($team->getMatchWon() + 3) + ($team->getMatchDraw() + 1);
        $this->setPoints($pts);
        return $this;

    }





}