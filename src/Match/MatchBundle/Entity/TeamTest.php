<?php

namespace Match\MatchBundle\Entity;

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
}
