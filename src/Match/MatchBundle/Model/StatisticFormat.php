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
    private $saves=0;
    private $cornerKicks=0;
    private $penaltyKicks=0;
    private $yellowCard=0;
    private $redCards=0;
    private $shots=0;

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