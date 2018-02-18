<?php

namespace Match\MatchBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="`match`")
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
     * @var
     * @ORM\ManyToOne(targetEntity="TeamTest")
     * @ORM\JoinColumn(name="id_team1",referencedColumnName="id")
     */
    private $team1;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="TeamTest")
     * @ORM\JoinColumn(name="id_team2",referencedColumnName="id")
     */
    private $team2;

    /**
     * @var string
     * @ORM\Column(name="levels", type="string")
     */
    private $level;


    /**
     * @var string
     * @ORM\Column(name="dates", type="string")
     */
    private $date;


    /**
     * @var string
     * @ORM\Column(name="times", type="string")
     */
    private $time;


    /**
     * @var string
     * @ORM\Column(name="stadiums", type="string")
     */
    private $stadium;

    /**
     * @var boolean
     * @ORM\Column(name="played", type="boolean")
     */
    private $played;

    /**
     * @var Statistics
     * @ORM\OneToMany(targetEntity="Match\MatchBundle\Entity\Statistics",mappedBy="match")
     */
    private $statistics;

    public function __construct()
    {
        $this->statistics = new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
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
     * Set team1.
     *
     * @param \Match\MatchBundle\Entity\TeamTest $team1
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
     * @return \Match\MatchBundle\Entity\TeamTest
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
     * @param string $date
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
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time.
     *
     * @param string $time
     *
     * @return Match
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time.
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set stadium.
     *
     * @param string $stadium
     *
     * @return Match
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Get stadium.
     *
     * @return string
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Add statistic.
     *
     * @param \Match\MatchBundle\Entity\statistics $statistic
     *
     * @return Match
     */
    public function addStatistic(\Match\MatchBundle\Entity\statistics $statistic)
    {
        $this->statistics[] = $statistic;

        return $this;
    }

    /**
     * Remove statistic.
     *
     * @param \Match\MatchBundle\Entity\statistics $statistic
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeStatistic(\Match\MatchBundle\Entity\statistics $statistic)
    {
        return $this->statistics->removeElement($statistic);
    }

    /**
     * Get statistics.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatistics()
    {
        return $this->statistics;
    }

    /**
     * Set played.
     *
     * @param bool $played
     *
     * @return Match
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played.
     *
     * @return bool
     */
    public function getPlayed()
    {
        return $this->played;
    }
}
