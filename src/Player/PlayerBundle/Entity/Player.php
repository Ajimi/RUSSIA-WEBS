<?php

namespace Player\PlayerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="Player\PlayerBundle\Repository\PlayerRepository")
 */
class Player
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
     * @ORM\Column(name="playerName", type="string", length=255)
     */
    private $playerName;

    /**
     * @var string
     *
     * @ORM\Column(name="playerLastName", type="string", length=255)
     */
    private $playerLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="playerImage", type="string", length=255)
     */
    private $playerImage;

    /**
     * @var string
     *
     * @ORM\Column(name="playerPosition", type="string", length=255)
     */
    private $playerPosition;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="decimal", precision=10, scale=0)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="decimal", precision=10, scale=0)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="totalGames", type="integer")
     */
    private $totalGames;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="text")
     */
    private $bio;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Team\TeamBundle\Entity\Team")
     * @ORM\JoinColumn(name="id_team1",referencedColumnName="id")
     */
    private $nationalTeam;

    /**
     * @var string
     *
     * @ORM\Column(name="team", type="string", length=255)
     */
    private $team;

    /**
     * @var int
     *
     * @ORM\Column(name="goalScored", type="integer")
     */
    private $goalScored;

    /**
     * @var int
     *
     * @ORM\Column(name="shots", type="integer")
     */
    private $shots;

    /**
     * @var int
     *
     * @ORM\Column(name="shotsOnTarget", type="integer")
     */
    private $shotsOnTarget;

    /**
     * @var int
     *
     * @ORM\Column(name="assists", type="integer")
     */
    private $assists;

    /**
     * @var int
     *
     * @ORM\Column(name="passes", type="integer")
     */
    private $passes;

    /**
     * @var int
     *
     * @ORM\Column(name="fouls", type="integer")
     */
    private $fouls;

    /**
     * @var int
     *
     * @ORM\Column(name="minutesPlayed", type="integer")
     */
    private $minutesPlayed;

    /**
     * @var int
     *
     * @ORM\Column(name="yellowCard", type="integer")
     */
    private $yellowCard;

    /**
     * @var int
     *
     * @ORM\Column(name="redCard", type="integer")
     */
    private $redCard;

    /**
     * @ORM\OneToMany(targetEntity="Player\PlayerBundle\Entity\Skill", mappedBy="player")
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity="Player\PlayerBundle\Entity\Club", mappedBy="player")
     */
    private $clubs;

    /**
     * Player constructor.
     */
    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->clubs = new ArrayCollection();
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
     * Set playerName.
     *
     * @param string $playerName
     *
     * @return Player
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;

        return $this;
    }

    /**
     * Get playerName.
     *
     * @return string
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * Set playerLastName.
     *
     * @param string $playerLastName
     *
     * @return Player
     */
    public function setPlayerLastName($playerLastName)
    {
        $this->playerLastName = $playerLastName;

        return $this;
    }

    /**
     * Get playerLastName.
     *
     * @return string
     */
    public function getPlayerLastName()
    {
        return $this->playerLastName;
    }

    /**
     * Set playerImage.
     *
     * @param string $playerImage
     *
     * @return Player
     */
    public function setPlayerImage($playerImage)
    {
        $this->playerImage = $playerImage;

        return $this;
    }

    /**
     * Get playerImage.
     *
     * @return string
     */
    public function getPlayerImage()
    {
        return $this->playerImage;
    }

    /**
     * Set playerPosition.
     *
     * @param string $playerPosition
     *
     * @return Player
     */
    public function setPlayerPosition($playerPosition)
    {
        $this->playerPosition = $playerPosition;

        return $this;
    }

    /**
     * Get playerPosition.
     *
     * @return string
     */
    public function getPlayerPosition()
    {
        return $this->playerPosition;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return Player
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set weight.
     *
     * @param string $weight
     *
     * @return Player
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight.
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height.
     *
     * @param string $height
     *
     * @return Player
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height.
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set totalGames.
     *
     * @param int $totalGames
     *
     * @return Player
     */
    public function setTotalGames($totalGames)
    {
        $this->totalGames = $totalGames;

        return $this;
    }

    /**
     * Get totalGames.
     *
     * @return int
     */
    public function getTotalGames()
    {
        return $this->totalGames;
    }

    /**
     * Set bio.
     *
     * @param string $bio
     *
     * @return Player
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio.
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set nationalTeam.
     *
     * @param string $nationalTeam
     *
     * @return Player
     */
    public function setNationalTeam($nationalTeam)
    {
        $this->nationalTeam = $nationalTeam;

        return $this;
    }

    /**
     * Get nationalTeam.
     *
     * @return string
     */
    public function getNationalTeam()
    {
        return $this->nationalTeam;
    }

    /**
     * Set team.
     *
     * @param string $team
     *
     * @return Player
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team.
     *
     * @return string
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set goalScored.
     *
     * @param int $goalScored
     *
     * @return Player
     */
    public function setGoalScored($goalScored)
    {
        $this->goalScored = $goalScored;

        return $this;
    }

    /**
     * Get goalScored.
     *
     * @return int
     */
    public function getGoalScored()
    {
        return $this->goalScored;
    }

    /**
     * Set shots.
     *
     * @param int $shots
     *
     * @return Player
     */
    public function setShots($shots)
    {
        $this->shots = $shots;

        return $this;
    }

    /**
     * Get shots.
     *
     * @return int
     */
    public function getShots()
    {
        return $this->shots;
    }

    /**
     * Set shotsOnTarget.
     *
     * @param int $shotsOnTarget
     *
     * @return Player
     */
    public function setShotsOnTarget($shotsOnTarget)
    {
        $this->shotsOnTarget = $shotsOnTarget;

        return $this;
    }

    /**
     * Get shotsOnTarget.
     *
     * @return int
     */
    public function getShotsOnTarget()
    {
        return $this->shotsOnTarget;
    }

    /**
     * Set assists.
     *
     * @param int $assists
     *
     * @return Player
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists.
     *
     * @return int
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set passes.
     *
     * @param int $passes
     *
     * @return Player
     */
    public function setPasses($passes)
    {
        $this->passes = $passes;

        return $this;
    }

    /**
     * Get passes.
     *
     * @return int
     */
    public function getPasses()
    {
        return $this->passes;
    }

    /**
     * Set fouls.
     *
     * @param int $fouls
     *
     * @return Player
     */
    public function setFouls($fouls)
    {
        $this->fouls = $fouls;

        return $this;
    }

    /**
     * Get fouls.
     *
     * @return int
     */
    public function getFouls()
    {
        return $this->fouls;
    }

    /**
     * Set minutesPlayed.
     *
     * @param int $minutesPlayed
     *
     * @return Player
     */
    public function setMinutesPlayed($minutesPlayed)
    {
        $this->minutesPlayed = $minutesPlayed;

        return $this;
    }

    /**
     * Get minutesPlayed.
     *
     * @return int
     */
    public function getMinutesPlayed()
    {
        return $this->minutesPlayed;
    }

    /**
     * Set yellowCard.
     *
     * @param int $yellowCard
     *
     * @return Player
     */
    public function setYellowCard($yellowCard)
    {
        $this->yellowCard = $yellowCard;

        return $this;
    }

    /**
     * Get yellowCard.
     *
     * @return int
     */
    public function getYellowCard()
    {
        return $this->yellowCard;
    }

    /**
     * Set redCard.
     *
     * @param int $redCard
     *
     * @return Player
     */
    public function setRedCard($redCard)
    {
        $this->redCard = $redCard;

        return $this;
    }

    /**
     * Get redCard.
     *
     * @return int
     */
    public function getRedCard()
    {
        return $this->redCard;
    }
}
