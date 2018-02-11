<?php

namespace Match\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="match")
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


}
