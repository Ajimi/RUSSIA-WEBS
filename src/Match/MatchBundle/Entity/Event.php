<?php

namespace Match\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="Match\MatchBundle\Repository\EventRepository")
 */
class Event
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
     * @var
     * @ORM\ManyToOne(targetEntity="Match\MatchBundle\Entity\TeamTest")
     * @ORM\JoinColumn(name="id_team",referencedColumnName="id")
     */
    private $team;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Match\MatchBundle\Entity\PlayerTest")
     * @ORM\JoinColumn(name="id_player",referencedColumnName="id")
     */
    private $player;


    /**
     * @var integer
     * @ORM\Column(name="minutes", type="integer")
     */
    private $minutes;

    /**
     * @var
     * @ORM\Column(name="times", type="datetime")
     */
    private $times;

    /**
     * @var string
     * @ORM\Column(name="type_event", type="string")
     */
    private $typeEvent;


    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;


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
     * Get typeEvent.
     *
     * @return string
     */
    public function getTypeEvent()
    {
        return $this->typeEvent;
    }

    /**
     * Set typeEvent.
     *
     * @param string $typeEvent
     *
     * @return Event
     */
    public function setTypeEvent($typeEvent)
    {
        $this->typeEvent = $typeEvent;

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
     * @return Event
     */
    public function setMatch(\Match\MatchBundle\Entity\Match $match = null)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get player.
     *
     * @return \Player\PlayerBundle\Entity\Player|null
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set player.
     *
     * @param \Player\PlayerBundle\Entity\Player|null $player
     *
     * @return Event
     */
    public function setPlayer(\Player\PlayerBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set team.
     *
     * @param \Match\MatchBundle\Entity\TeamTest|null $team
     *
     * @return Event
     */
    public function setTeam(\Match\MatchBundle\Entity\TeamTest $team = null)
    {
        $this->team = $team;

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
     * Set times.
     *
     * @param string $times
     *
     * @return Event
     */
    public function setTimes($times)
    {
        $this->times = $times;

        return $this;
    }

    /**
     * Get times.
     *
     * @return string
     */
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * Set minutes.
     *
     * @param int $minutes
     *
     * @return Event
     */
    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;

        return $this;
    }

    /**
     * Get minutes.
     *
     * @return int
     */
    public function getMinutes()
    {
        return $this->minutes;
    }
}
