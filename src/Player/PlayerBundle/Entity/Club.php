<?php

namespace Player\PlayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="Player\PlayerBundle\Repository\ClubRepository")
 */
class Club
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
     * @var string
     *
     * @ORM\Column(name="clubName", type="string", length=255)
     */
    private $clubName;

    /**
     * @var int
     *
     * @ORM\Column(name="seasonStart", type="integer")
     */
    private $seasonStart;

    /**
     * @var int
     *
     * @ORM\Column(name="seasonEnd", type="integer")
     */
    private $seasonEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="matchPlayer", type="integer")
     */
    private $matchPlayer;

    /**
     * @var int
     *
     * @ORM\Column(name="goalScored", type="integer")
     */
    private $goalScored;

    /**
     * @ORM\ManyToOne(targetEntity="Player\PlayerBundle\Entity\Player", inversedBy="skills")
     * @ORM\JoinColumn(nullable=true)
     */
    private $player;

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
     * Set clubName.
     *
     * @param string $clubName
     *
     * @return Club
     */
    public function setClubName($clubName)
    {
        $this->clubName = $clubName;

        return $this;
    }

    /**
     * Get clubName.
     *
     * @return string
     */
    public function getClubName()
    {
        return $this->clubName;
    }

    /**
     * Set seasonStart.
     *
     * @param int $seasonStart
     *
     * @return Club
     */
    public function setSeasonStart($seasonStart)
    {
        $this->seasonStart = $seasonStart;

        return $this;
    }

    /**
     * Get seasonStart.
     *
     * @return int
     */
    public function getSeasonStart()
    {
        return $this->seasonStart;
    }

    /**
     * Set seasonEnd.
     *
     * @param int $seasonEnd
     *
     * @return Club
     */
    public function setSeasonEnd($seasonEnd)
    {
        $this->seasonEnd = $seasonEnd;

        return $this;
    }

    /**
     * Get seasonEnd.
     *
     * @return int
     */
    public function getSeasonEnd()
    {
        return $this->seasonEnd;
    }

    /**
     * Set matchPlayer.
     *
     * @param int $matchPlayer
     *
     * @return Club
     */
    public function setMatchPlayer($matchPlayer)
    {
        $this->matchPlayer = $matchPlayer;

        return $this;
    }

    /**
     * Get matchPlayer.
     *
     * @return int
     */
    public function getMatchPlayer()
    {
        return $this->matchPlayer;
    }

    /**
     * Set goalScored.
     *
     * @param int $goalScored
     *
     * @return Club
     */
    public function setGoalScored($goalScored)
    {
        $this->goalScored = $goalScored;

        return $this;
    }

    /**
     * Get goalScored.
     *
     * @return int
     */
    public function getGoalScored()
    {
        return $this->goalScored;
    }
}
