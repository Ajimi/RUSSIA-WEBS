<?php

namespace Match\MatchBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TeamTest
 *
 * @ORM\Table(name="team_test")
 * @ORM\Entity(repositoryClass="Match\MatchBundle\Repository\TeamTestRepository")
 */
class TeamTest
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
     * @var Statistics
     * @ORM\OneToMany(targetEntity="Match\MatchBundle\Entity\Statistics",mappedBy="team")
     */
    private $statistics;

    public function __construct()
    {
        $this->statistics = new ArrayCollection();
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
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;


    /**
     * Set name.
     *
     * @param string $name
     *
     * @return TeamTest
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
     * Add statistic.
     *
     * @param \Match\MatchBundle\Entity\statistics $statistic
     *
     * @return TeamTest
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
}
