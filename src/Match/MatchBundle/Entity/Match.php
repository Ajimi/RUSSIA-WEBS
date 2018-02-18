<?php

namespace Match\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="matches")
 * @ORM\Entity(repositoryClass="Match\MatchBundle\Repository\MatchRepository")
 */
class Match
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
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="TeamTest")
     * @ORM\JoinColumn(name="id_team",referencedColumnName="id")
     */
    private $team1;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="TeamTest")
     * @ORM\JoinColumn(name="id_team",referencedColumnName="id")
     */
    private $team2;

    /**
     *
     * @ORM\Column(type="date")
     */
    private $date;

    private $heur;

    /**
     * @var string
     * @ORM\Column(name="stade", type="string")
     */
    private $stade;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Match
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Match
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set stade.
     *
     * @param string $stade
     *
     * @return Match
     */
    public function setStade($stade)
    {
        $this->stade = $stade;

        return $this;
    }

    /**
     * Get stade.
     *
     * @return string
     */
    public function getStade()
    {
        return $this->stade;
    }

    /**
     * Set team1.
     *
     * @param \Match\MatchBundle\Entity\TeamTest|null $team1
     *
     * @return Match
     */
    public function setTeam1(\Match\MatchBundle\Entity\TeamTest $team1 = null)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1.
     *
     * @return \Match\MatchBundle\Entity\TeamTest|null
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2.
     *
     * @param \Match\MatchBundle\Entity\TeamTest|null $team2
     *
     * @return Match
     */
    public function setTeam2(\Match\MatchBundle\Entity\TeamTest $team2 = null)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2.
     *
     * @return \Match\MatchBundle\Entity\TeamTest|null
     */
    public function getTeam2()
    {
        return $this->team2;
    }
}
