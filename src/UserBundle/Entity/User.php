<?php

namespace UserBundle\Entity;

use Common\BookingBundle\Entity\Booking;
use Common\UploadBundle\Annotation\Uploadable;
use Common\UploadBundle\Annotation\UploadableField;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @Uploadable()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $stripeCustomerId;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @ORM\OneToMany(targetEntity="News\NewsBundle\Entity\Article", mappedBy="author")
     */
    private $articles;


    /**
     *
     * @ORM\OneToMany(targetEntity="Group\GroupBundle\Entity\Rating", mappedBy="userId", cascade={"remove"}, orphanRemoval=true)
     */
    private $rating;

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
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @var
     * @ORM\Column(type="string" , length=255 , nullable=true)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Common\BookingBundle\Entity\Booking",
     *     mappedBy="user"
     * )
     * @ORM\JoinColumn(nullable=true)
     */
    private $bookings;

    /**
     * @ORM\Column(name="image" , type="string", nullable=true)
     */
    private $image;
    /**
     * @UploadableField(filename="image", path="assets/images/user")
     */
    private $file;
    private $hasPhone = false;
    private $hasAddress = false;
    private $hasImage = false;

    public function __construct()
    {
        parent::__construct();
        $this->bookings = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function addBooking(Booking $booking)
    {
        if ($this->bookings->contains($booking)) {
            return;
        }

        $this->bookings[] = $booking;
        // needed to update the owning side of the relationship!
        $booking->setUser($this);
    }

    public function removeBooking(Booking $booking)
    {
        if (!$this->bookings->contains($booking)) {
            return;
        }

        $this->bookings->removeElement($booking);
        // needed to update the owning side of the relationship!
        $booking->setUser(null);
    }

    /**
     * @return ArrayCollection|Booking[]
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }


    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->username;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getStripeCustomerId()
    {
        return $this->stripeCustomerId;
    }

    /**
     * @param mixed $stripeCustomerId
     */
    public function setStripeCustomerId($stripeCustomerId)
    {
        $this->stripeCustomerId = $stripeCustomerId;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        if (is_null($this->phone)) {
            return "You don't have a phone number";
            $this->hasPhone = false;
        }
        $this->hasPhone = true;
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getHasPhone()
    {
        return $this->hasPhone;
    }

    /**
     * @param mixed $hasPhone
     */
    public function setHasPhone($hasPhone): void
    {
        $this->hasPhone = $hasPhone;
    }

    /**
     * @return mixed
     */
    public function getHasAddress()
    {
        return $this->hasAddress;
    }

    /**
     * @param mixed $hasAddress
     */
    public function setHasAddress($hasAddress): void
    {
        $this->hasAddress = $hasAddress;
    }

    /**
     * @return string
     */
    public function getAddress()
    {

        if (is_null($this->address))
            $this->hasAddress = false;

        $this->hasAddress = true;
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        if (is_null($this->image)) {
            $this->hasImage = false;
            return "avatar.jpg";
        }
        $this->hasImage = true;
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getHasImage()
    {
        return $this->hasImage;
    }

    /**
     * @param mixed $hasImage
     */
    public function setHasImage($hasImage): void
    {
        $this->hasImage = $hasImage;
    }

    public function __toString()
    {
        return $this->username;
    }



    /**
     * Add article.
     *
     * @param \News\NewsBundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\News\NewsBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article.
     *
     * @param \News\NewsBundle\Entity\Article $article
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArticle(\News\NewsBundle\Entity\Article $article)
    {
        return $this->articles->removeElement($article);
    }

    /**
     * Get articles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
