<?php

namespace Match\MatchBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Reservation\TicketBundle\Entity\Ticket;

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
     * @ORM\ManyToOne(targetEntity="Team\TeamBundle\Entity\Team")
     * @ORM\JoinColumn(name="id_team1",referencedColumnName="id")
     */
    private $team1;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Team\TeamBundle\Entity\Team")
     * @ORM\JoinColumn(name="id_team2",referencedColumnName="id")
     */
    private $team2;

    /**
     * @var string
     * @ORM\Column(name="levels", type="string")
     */
    private $level;


    /**
     * @var DateTime
     * @ORM\Column(name="dates", type="date")
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
     * @var Ticket
     *
     * @ORM\OneToOne(targetEntity="Reservation\TicketBundle\Entity\Ticket" , mappedBy="match", cascade={"remove"})
     */
    private $ticket;


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
     * Set level
     *
     * @param string $level
     *
     * @return Match
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }



    /**
     * Set time
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
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set stadium
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
     * Get stadium
     *
     * @return string
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Set played
     *
     * @param boolean $played
     *
     * @return Match
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played
     *
     * @return boolean
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set team1
     *
     * @param \Team\TeamBundle\Entity\Team $team1
     *
     * @return Match
     */
    public function setTeam1(\Team\TeamBundle\Entity\Team $team1 = null)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return \Team\TeamBundle\Entity\Team
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param \Team\TeamBundle\Entity\Team $team2
     *
     * @return Match
     */
    public function setTeam2(\Team\TeamBundle\Entity\Team $team2 = null)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return \Team\TeamBundle\Entity\Team
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set ticket
     *
     * @param \Reservation\TicketBundle\Entity\Ticket $ticket
     *
     * @return Match
     */
    public function setTicket(\Reservation\TicketBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Reservation\TicketBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
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
}