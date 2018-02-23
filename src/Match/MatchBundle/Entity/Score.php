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
     * @ORM\JoinColumn(name="id_match",referencedColumnName="id")
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set scoreTeam1
     *
     * @param integer $scoreTeam1
     *
     * @return Score
     */
    public function setScoreTeam1($scoreTeam1)
    {
        $this->scoreTeam1 = $scoreTeam1;

        return $this;
    }

    /**
     * Get scoreTeam1
     *
     * @return integer
     */
    public function getScoreTeam1()
    {
        return $this->scoreTeam1;
    }

    /**
     * Set scoreTeam2
     *
     * @param integer $scoreTeam2
     *
     * @return Score
     */
    public function setScoreTeam2($scoreTeam2)
    {
        $this->scoreTeam2 = $scoreTeam2;

        return $this;
    }

    /**
     * Get scoreTeam2
     *
     * @return integer
     */
    public function getScoreTeam2()
    {
        return $this->scoreTeam2;
    }

    /**
     * Set match
     *
     * @param \Match\MatchBundle\Entity\Match $match
     *
     * @return Score
     */
    public function setMatch(\Match\MatchBundle\Entity\Match $match = null)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \Match\MatchBundle\Entity\Match
     */
    public function getMatch()
    {
        return $this->match;
    }
}
