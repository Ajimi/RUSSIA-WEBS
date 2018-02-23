<?php

namespace Reservation\TicketBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Matche
 *
 * @ORM\Table(name="matche")
 * @ORM\Entity(repositoryClass="Reservation\TicketBundle\Repository\MatcheRepository")
 */
class Matche
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
     * @ORM\Column(name="team1", type="string", length=255)
     */
    private $team1;

    /**
     * @var string
     *
     * @ORM\Column(name="team2", type="string", length=255)
     */
    private $team2;

    /**
     * @var Ticket
     *
     * @ORM\OneToOne(targetEntity="Reservation\TicketBundle\Entity\Ticket" , mappedBy="matche")
     */
    private $ticket;


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
     * Get team1
     *
     * @return string
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team1
     *
     * @param string $team1
     *
     * @return Matche
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team2
     *
     * @return string
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set team2
     *
     * @param string $team2
     *
     * @return Matche
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get tickets
     *
     */
    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    /**
     * @param Ticket $ticket
     */
    public function setTicket(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
}
