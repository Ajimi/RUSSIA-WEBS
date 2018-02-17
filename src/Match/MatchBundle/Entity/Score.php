<?php

namespace Match\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score")
 * @ORM\Entity(repositoryClass="Match\MatchBundle\Repository\ScoreRepository")
 */
class Score
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
    private $score;

    /**
     * Score constructor.
     * @param $team
     * @param $match
     * @param int $score
     */
    public function __construct($team, $match, $score)
    {
        $this->team = $team;
        $this->match = $match;
        $this->score = $score;
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
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set score.
     *
     * @param int $score
     *
     * @return Score
     */
    public function setScore($score)
    {
        $this->score = $score;

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
     * @return Score
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
     * @return Score
     */
    public function setMatch(\Match\MatchBundle\Entity\Match $match = null)
    {
        $this->match = $match;

        return $this;
    }
}
