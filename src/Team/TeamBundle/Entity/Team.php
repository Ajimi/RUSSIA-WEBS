<?php

namespace Team\TeamBundle\Entity;

use Common\UploadBundle\Annotation\Uploadable;
use Common\UploadBundle\Annotation\UploadableField;
use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="Team\TeamBundle\Repository\TeamRepository")
 * @Uploadable()
 */
class Team
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
     * @ORM\Column(name="teamName", type="string", length=255)
     */
    private $teamName;

    /**
     * @var string
     * @UploadableField(filename="teamLogo",path="assets/images/teamUploads")
     * @ORM\Column(name="teamLogo", type="string", length=255)
     */
    private $teamLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="teamShortcut", type="string", length=255)
     */
    private $teamShortcut;


    /**
     * @var int
     *
     * @ORM\Column(name="matchWon", type="integer")
     */
    private $matchWon;

    /**
     * @var int
     *
     * @ORM\Column(name="matchLoss", type="integer")
     */
    private $matchLost;

    /**
     * @var int
     *
     * @ORM\Column(name="goalScored", type="integer")
     */
    private $goalScored;

    /**
     * @var int
     *
     * @ORM\Column(name="goalIn", type="integer")
     */
    private $goalIn;
    /**
     * @var int
     *
     * @ORM\Column(name="matchDraw", type="integer")
     */
    private $matchDraw;

    /**
     * @var int
     *
     * @ORM\Column(name="participation", type="integer")
     */
    private $participation;

    /**
     * @var int
     *
     * @ORM\Column(name="winner", type="integer")
     */
    private $winner;

    /**
     * @var int
     *
     * @ORM\Column(name="second", type="integer")
     */
    private $second;

    /**
     * @var int
     *
     * @ORM\Column(name="third", type="integer")
     */
    private $third;


    /**
     * @ORM\OneToMany(targetEntity="Player\PlayerBundle\Entity\Player", mappedBy="team")
     */
    private $players;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get teamName
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set teamName
     *
     * @param string $teamName
     *
     * @return Team
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * @return int
     */
    public function getGoalIn()
    {
        return $this->goalIn;
    }

    /**
     * @return mixed
     */
    public function getTeamLogo()
    {
        return $this->teamLogo;
    }

    /**
     * @param mixed $teamLogo
     */
    public function setTeamLogo($teamLogo)
    {
        $this->teamLogo = $teamLogo;
    }


    /**
     * @param int $goalIn
     */
    public function setGoalIn($goalIn)
    {
        $this->goalIn = $goalIn;
    }

    /**
     * Get teamShortcut
     *
     * @return string
     */
    public function getTeamShortcut()
    {
        return $this->teamShortcut;
    }

    /**
     * Set teamShortcut
     *
     * @param string $teamShortcut
     *
     * @return Team
     */
    public function setTeamShortcut($teamShortcut)
    {
        $this->teamShortcut = $teamShortcut;

        return $this;
    }


    /**
     * Get matchWon
     *
     * @return int
     */
    public function getMatchWon()
    {
        return $this->matchWon;
    }

    /**
     * Set matchWon
     *
     * @param integer $matchWon
     *
     * @return Team
     */
    public function setMatchWon($matchWon)
    {
        $this->matchWon = $matchWon;

        return $this;
    }

    /**
     * Get matchLoss
     *
     * @return int
     */
    public function getMatchLost()
    {
        return $this->matchLost;
    }

    /**
     * Set matchLoss
     *
     * @param integer $matchLost
     *
     * @return Team
     */
    public function setMatchLost($matchLost)
    {
        $this->matchLost = $matchLost;

        return $this;
    }

    /**
     * Get goalScored
     *
     * @return int
     */
    public function getGoalScored()
    {
        return $this->goalScored;
    }

    /**
     * Set goalScored
     *
     * @param integer $goalScored
     *
     * @return Team
     */
    public function setGoalScored($goalScored)
    {
        $this->goalScored = $goalScored;

        return $this;
    }

    /**
     * Get matchDraw
     *
     * @return int
     */
    public function getMatchDraw()
    {
        return $this->matchDraw;
    }

    /**
     * Set matchDraw
     *
     * @param integer $matchDraw
     *
     * @return Team
     */
    public function setMatchDraw($matchDraw)
    {
        $this->matchDraw = $matchDraw;

        return $this;
    }

    /**
     * Get participation
     *
     * @return int
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * Set participation
     *
     * @param integer $participation
     *
     * @return Team
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get winner
     *
     * @return int
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set winner
     *
     * @param integer $winner
     *
     * @return Team
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get second
     *
     * @return int
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * Set second
     *
     * @param integer $second
     *
     * @return Team
     */
    public function setSecond($second)
    {
        $this->second = $second;

        return $this;
    }

    /**
     * Get third
     *
     * @return int
     */
    public function getThird()
    {
        return $this->third;
    }

    /**
     * Set third
     *
     * @param integer $third
     *
     * @return Team
     */
    public function setThird($third)
    {
        $this->third = $third;

        return $this;
    }
}

