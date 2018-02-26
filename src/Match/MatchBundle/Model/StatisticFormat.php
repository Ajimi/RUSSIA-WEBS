<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 22/02/2018
 * Time: 00:11
 */

namespace  Match\MatchBundle\Model;
class StatisticFormat
{

    private $cornerKicks=0;
    private $penaltyKicks=0;
    private $yellowCard=0;
    private $redCards=0;
    private $shots=0;
    private $shotsOnTarget=0;
    private $passes=0;
    private $assist=0;
    private $fouls=0;
    private $saves=0;

    /**
     * @return int
     */
    public function getShotsOnTarget(): int
    {
        return $this->shotsOnTarget;
    }

    /**
     * @param int $shotsOnTarget
     */
    public function setShotsOnTarget(int $shotsOnTarget)
    {
        $this->shotsOnTarget = $shotsOnTarget;
    }

    /**
     * @return int
     */
    public function getPasses(): int
    {
        return $this->passes;
    }

    /**
     * @param int $passes
     */
    public function setPasses(int $passes)
    {
        $this->passes = $passes;
    }

    /**
     * @return int
     */
    public function getAssist(): int
    {
        return $this->assist;
    }

    /**
     * @param int $assist
     */
    public function setAssist(int $assist)
    {
        $this->assist = $assist;
    }

    /**
     * @return mixed
     */
    public function getFouls()
    {
        return $this->fouls;
    }

    /**
     * @param mixed $fouls
     */
    public function setFouls($fouls)
    {
        $this->fouls = $fouls;
    }

    /**
     * StatisticFormat constructor.
     */
    public function __construct()
    {
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
    public function getSaves()
    {
        return $this->saves;
    }

    /**
     * @param mixed $saves
     */
    public function setSaves($saves)
    {
        $this->saves = $saves;
    }

    /**
     * @return mixed
     */
    public function getCornerKicks()
    {
        return $this->cornerKicks;
    }

    /**
     * @param mixed $cornerKicks
     */
    public function setCornerKicks($cornerKicks)
    {
        $this->cornerKicks = $cornerKicks;
    }

    /**
     * @return mixed
     */
    public function getPenaltyKicks()
    {
        return $this->penaltyKicks;
    }

    /**
     * @param mixed $penaltyKicks
     */
    public function setPenaltyKicks($penaltyKicks)
    {
        $this->penaltyKicks = $penaltyKicks;
    }

    /**
     * @return mixed
     */
    public function getYellowCard()
    {
        return $this->yellowCard;
    }

    /**
     * @param mixed $yellowCard
     */
    public function setYellowCard($yellowCard)
    {
        $this->yellowCard = $yellowCard;
    }

    /**
     * @return mixed
     */
    public function getRedCards()
    {
        return $this->redCards;
    }

    /**
     * @param mixed $redCards
     */
    public function setRedCards($redCards)
    {
        $this->redCards = $redCards;
    }



    public function  dataFormat( \Match\MatchBundle\Entity\Event $event)
    {
        if ($event->getTypeEvent()=="Foul")
        {
            $this->setFouls($this->getFouls()+1);
        }
        else if ($event->getTypeEvent()=="Assist")
        {
            $this->setAssist($this->getAssist()+1);
        }
        else if ($event->getTypeEvent()=="Pass")
        {
            $this->setPasses($this->getPasses()+1);
        }
        if ($event->getTypeEvent()=="Shot(On Target)")
        {
            $this->setShots($this->getShots()+1);
        }
        else if ($event->getTypeEvent()=="Save")
        {
            $this->setSaves($this->getSaves()+1);
        }
        else if ($event->getTypeEvent()=="Corner Kick")
        {
            $this->setCornerKicks($this->getCornerKicks()+1);
        }
        else if ($event->getTypeEvent()=="Penalty Kick")
        {
            $this->setPenaltyKicks($this->getPenaltyKicks()+1);
        }
        else if ($event->getTypeEvent()=="Yellow Card")
        {
            $this->setYellowCard($this->getYellowCard()+1);
        }
        else if ($event->getTypeEvent()=="Red Card")
        {
            $this->setRedCards($this->getRedCards()+1);
        }

        return $this;

    }

}