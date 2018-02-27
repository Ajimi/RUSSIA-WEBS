<?php

namespace News\NewsBundle\Entity;

use Common\UploadBundle\Annotation\UploadableField;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Date;
use Gedmo\Mapping\Annotation as Gedmo;
use UserBundle\Entity\User;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="News\NewsBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="articles");
     */
    private $author;

    /**
     * @var \DateTime $created
     * @ORM\Column(type="date", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(type="date", nullable=true)
     * @Gedmo\Timestampable
     */
    private $updated;


    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * @var VoteUp[] $voteUp
     * @ORM\OneToMany(targetEntity="News\NewsBundle\Entity\VoteUp" , mappedBy="article")
     */
    private $votes;

    /**
     * @var string $image
     * @ORM\Column(name="image", type="string")
     */
    private $image;

    /**
     * @var File $file
     * @UploadableField(filename="image", path="assets/images/news")
     */
    private $file;

    /**
     * @var Badge
     * @ORM\OneToOne(targetEntity="News\NewsBundle\Entity\Badge" , inversedBy="article", cascade={"persist"})
     */
    private $badge;

    /**
     * @var string $badgeName
     */
    private $badgeName;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * TODO : Add Image for each Article;
     */

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
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return null|User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param null|User $author
     * @return null|User
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }


    /**
     * Add vote
     *
     * @param \News\NewsBundle\Entity\VoteUp $vote
     *
     * @return Article
     */
    public function addVote(\News\NewsBundle\Entity\VoteUp $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \News\NewsBundle\Entity\VoteUp $vote
     */
    public function removeVote(\News\NewsBundle\Entity\VoteUp $vote)
    {
        $this->votes->removeElement($vote);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return Badge
     */
    public function getBadge(): ?Badge
    {
        return $this->badge;
    }

    /**
     * @param Badge $badge
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    }

    /**
     * @return string
     */
    public function getBadgeName(): ?string
    {
        return $this->badgeName;
    }

    /**
     * @param string $badgeName
     */
    public function setBadgeName($badgeName)
    {
        $this->badgeName = $badgeName;
    }


}
