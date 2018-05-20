<?php

namespace Group\GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="Group\GroupBundle\Repository\GroupeRepository")
 */
class Groupe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id=primarykey
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nameGroup", type="string", length=255)
     */
    private $nameGroup;

//@ORM\OneToMany(targetEntity="Group\GroupBundle\Entity\Rating", mappedBy="groupId", cascade={"remove"}, orphanRemoval=true)
    /**
     *
     * @ORM\Column( type="integer")
     */
    private $rating;

    /**
     * Groupe constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Groupe constructor.
     */


    /**
     * @var
     * @ORM\OneToOne(targetEntity="Team\TeamBundle\Entity\Team")
     * @ORM\JoinColumn(name="id_team1",referencedColumnName="id")
     */
    private $team1;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="Team\TeamBundle\Entity\Team")
     * @ORM\JoinColumn(name="id_team2",referencedColumnName="id")
     */
    private $team2;
    /**
     * @var
     * @ORM\OneToOne(targetEntity="Team\TeamBundle\Entity\Team")
     * @ORM\JoinColumn(name="id_team4",referencedColumnName="id")
     */
    private $team4;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @var
     * @ORM\OneToOne(targetEntity="Team\TeamBundle\Entity\Team")
     * @ORM\JoinColumn(name="id_team3",referencedColumnName="id")
     */
    private $team3;

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getNameGroup()
    {
        return $this->nameGroup;
    }

    /**
     * @param string $nameGroup
     */
    public function setNameGroup(string $nameGroup)
    {
        $this->nameGroup = $nameGroup;
    }

    /**
     * @return mixed
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * @param mixed $team1
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;
    }

    /**
     * @return mixed
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * @param mixed $team2
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;
    }

    /**
     * @return mixed
     */
    public function getTeam3()
    {
        return $this->team3;
    }

    /**
     * @param mixed $team3
     */
    public function setTeam3($team3)
    {
        $this->team3 = $team3;
    }

    /**
     * @return mixed
     */
    public function getTeam4()
    {
        return $this->team4;
    }

    /**
     * @param mixed $team4
     */
    public function setTeam4($team4)
    {
        $this->team4 = $team4;
    }


}
