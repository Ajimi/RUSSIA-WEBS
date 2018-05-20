<?php

namespace Forum\ForumBundle\Entity;

use Common\UploadBundle\Annotation\UploadableField;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;
use UserBundle\Entity\User;


/**
 * Subject
 * @ORM\Table(name="subject")
 * @ORM\Entity(repositoryClass="Forum\ForumBundle\Repository\SubjectRepository")
 */
class Subject
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
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $auther;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=20000)
     */
    private $content;


    /**
     * @var string
     *
     * @ORM\Column(name="image" , type="string", length=255, nullable=true)
     */
    private $filename;
    /**
     * @var File
     * @UploadableField(filename="filename",path="\assets\images\Sujet")
     *
     */
    private $file;
    /**
     * @var string
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var \DateTime|null $created
     *
     * @ORM\Column(type="date", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $created;


    /**
     * @var \DateTime|null $created
     *
     * @ORM\Column(type="date", nullable=true)
     * @Gedmo\Timestampable
     */
    private $updated;

    /**
     * @var Comment[]
     * @ORM\OneToMany(targetEntity="Forum\ForumBundle\Entity\Comment", mappedBy="subject")
     *
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Subject
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Subject
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
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
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return File
     */
    public function getFile()
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
     * @return \DateTime|null
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime|null $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }


//    /**
//     * Add author.
//     *
//     * @param \UserBundle\Entity\User $author
//     *
//     * @return Subject
//     */
//    public function addAuthor(\UserBundle\Entity\User $author)
//    {
//        $this->author[] = $author;
//
//        return $this;
//    }
//
//    /**
//     * Remove author.
//     *
//     * @param \UserBundle\Entity\User $author
//     *
//     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
//     */
//    public function removeAuthor(\UserBundle\Entity\User $author)
//    {
//        return $this->author->removeElement($author);
//    }

    /**
     * Add comment.
     *
     * @param \Forum\ForumBundle\Entity\Comment $comment
     *
     * @return Subject
     */
    public function addComment(\Forum\ForumBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment.
     *
     * @param \Forum\ForumBundle\Entity\Comment $comment
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeComment(\Forum\ForumBundle\Entity\Comment $comment)
    {
        return $this->comments->removeElement($comment);
    }

    /**
     * Get comments.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }





    /**
     * Set auther.
     *
     * @param \UserBundle\Entity\User|null $auther
     *
     * @return Subject
     */
    public function setAuther(\UserBundle\Entity\User $auther = null)
    {
        $this->auther = $auther;

        return $this;
    }

    /**
     * Get auther.
     *
     * @return \UserBundle\Entity\User|null
     */
    public function getAuther()
    {
        return $this->auther;
    }
}
