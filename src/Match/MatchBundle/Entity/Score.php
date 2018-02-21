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
     * @ORM\ManyToOne(targetEntity="Match\MatchBundle\Entity\Match")
     * @ORM\JoinColumn(name="id_match",referencedColumnName="id", onDelete="CASCADE")
     */
    private $match;

    /**
     * @var integer
     * @ORM\Column(name="score_team1", type="integer")
     */
    private $scoreTeam1;


    /**
     * @var integer
     * @ORM\Column(name="score_team2", type="integer")
     */
    private $scoreTeam2;


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
     * Get scoreTeam1.
     *
     * @return int
     */
    public function getScoreTeam1()
    {
        return $this->scoreTeam1;
    }

    /**
     * Set scoreTeam1.
     *
     * @param int $scoreTeam1
     *
     * @return Score
     */
    public function setScoreTeam1($scoreTeam1)
    {
        $this->scoreTeam1 = $scoreTeam1;

        return $this;
    }

    /**
     * Get scoreTeam2.
     *
     * @return int
     */
    public function getScoreTeam2()
    {
        return $this->scoreTeam2;
    }

    /**
     * Set scoreTeam2.
     *
     * @param int $scoreTeam2
     *
     * @return Score
     */
    public function setScoreTeam2($scoreTeam2)
    {
        $this->scoreTeam2 = $scoreTeam2;

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
