<?php

namespace News\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @var date $created
     * @ORM\Column(type="date")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var date $updated
     *
     * @ORM\Column(type="date")
     * @Gedmo\Timestampable
     */
    private $updated;


    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


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
     * @return Date
     */
    public function getCreated(): Date
    {
        return $this->created;
    }

    /**
     * @param Date $created
     */
    public function setCreated(Date $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getContentChanged(): \DateTime
    {
        return $this->contentChanged;
    }

    /**
     * @param \DateTime $contentChanged
     */
    public function setContentChanged(\DateTime $contentChanged)
    {
        $this->contentChanged = $contentChanged;
    }

    /**
     * @return Date
     */
    public function getUpdated(): Date
    {
        return $this->updated;
    }

    /**
     * @param Date $updated
     */
    public function setUpdated(Date $updated)
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
}

