<?php

namespace Match\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistics
 *
 * @ORM\Table(name="statistics")
 * @ORM\Entity(repositoryClass="Match\MatchBundle\Repository\StatisticsRepository")
 */
class Statistics
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="TeamTest")
     * @ORM\JoinColumn(name="id_team",referencedColumnName="id")
     */
    private $team;
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumn(name="id_match",referencedColumnName="id")
     */

    private $match;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $shots;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $cornerKicks;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $saves;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $yellowCards;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $redCards;

    /**
     * Statistics constructor.
     * @param $team
     * @param $match
     * @param int $shots
     * @param int $cornerkicks
     * @param int $saves
     * @param int $yellowCards
     * @param int $redCards
     */
    public function __construct($team, $match, $shots, $cornerkicks, $saves, $yellowCards, $redCards)
    {
        $this->team = $team;
        $this->match = $match;
        $this->shots = $shots;
        $this->cornerKicks = $cornerkicks;
        $this->saves = $saves;
        $this->yellowCards = $yellowCards;
        $this->redCards = $redCards;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get score.
     *
     * @return int
     */
    public function getShots()
    {
        return $this->shots;
    }

    /**
     * Set score.
     *
     * @param int $score
     *
     * @return Statistics
     */
    public function setShots($shots)
    {
        $this->shots = $shots;

        return $this;
    }

    /**
     * Get team.
     *
     * @return \Match\MatchBundle\Entity\TeamTest|null
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set team.
     *
     * @param \Match\MatchBundle\Entity\TeamTest|null $team
     *
     * @return Statistics
     */
    public function setTeam(\Match\MatchBundle\Entity\TeamTest $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get match.
     *
     * @return \Match\MatchBundle\Entity\Match|null
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set match.
     *
     * @param \Match\MatchBundle\Entity\Match|null $match
     *
     * @return Statistics
     */
    public function setMatch(\Match\MatchBundle\Entity\Match $match = null)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Set cornerKicks.
     *
     * @param int $cornerKicks
     *
     * @return Statistics
     */
    public function setCornerKicks($cornerKicks)
    {
        $this->cornerKicks = $cornerKicks;

        return $this;
    }

    /**
     * Get cornerKicks.
     *
     * @return int
     */
    public function getCornerKicks()
    {
        return $this->cornerKicks;
    }

    /**
     * Set saves.
     *
     * @param int $saves
     *
     * @return Statistics
     */
    public function setSaves($saves)
    {
        $this->saves = $saves;

        return $this;
    }

    /**
     * Get saves.
     *
     * @return int
     */
    public function getSaves()
    {
        return $this->saves;
    }

    /**
     * Set yellowCards.
     *
     * @param int $yellowCards
     *
     * @return Statistics
     */
    public function setYellowCards($yellowCards)
    {
        $this->yellowCards = $yellowCards;

        return $this;
    }

    /**
     * Get yellowCards.
     *
     * @return int
     */
    public function getYellowCards()
    {
        return $this->yellowCards;
    }

    /**
     * Set redCards.
     *
     * @param int $redCards
     *
     * @return Statistics
     */
    public function setRedCards($redCards)
    {
        $this->redCards = $redCards;

        return $this;
    }

    /**
     * Get redCards.
     *
     * @return int
     */
    public function getRedCards()
    {
        return $this->redCards;
    }
}
