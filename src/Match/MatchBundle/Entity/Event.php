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
     * @ORM\JoinColumn(name="id_match",referencedColumnName="id")
     */
    private $match;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Player\PlayerBundle\Entity\Player")
     * @ORM\JoinColumn(name="id_match",referencedColumnName="id")
     */
    private $player;


    /**
     * @var string
     * @ORM\Column(name="times", type="string")
     */
    private $time;

    /**
     * @var string
     * @ORM\Column(name="type_event", type="string")
     */
    private $typeEvent;

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
     * Get time.
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set time.
     *
     * @param string $time
     *
     * @return Event
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
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
}
