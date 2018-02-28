<?php

namespace News\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * VoteUp
 *
 * @ORM\Table(name="vote_up")
 * @ORM\Entity(repositoryClass="News\NewsBundle\Repository\VoteUpRepository")
 */
class VoteUp
{

    const VOTE_UP = 1; // LIKE
    const VOTE_DOWN = 2; // DISLIKE
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="News\NewsBundle\Entity\Article", inversedBy="votes")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=true) TODO : Change it to false
     */
    private $article;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true) TODO : Change it to false
     */
    private $user;
    /**
     * @var int
     *
     * @ORM\Column(name="voteUp", type="integer")
     */
    private $voteUp;


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
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return VoteUp
     */
    public function setArticle(Article $article): VoteUp
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return VoteUp
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return int
     */
    public function getVoteUp(): int
    {
        return $this->voteUp;
    }

    /**
     * @param int $voteUp
     * @return VoteUp
     */
    public function setVoteUp(int $voteUp): VoteUp
    {
        $this->voteUp = $voteUp;
        return $this;
    }
}

