<?php

namespace Group\GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Rating
 *
 * @ORM\Table(name="rating",
 *    uniqueConstraints={
 *        @UniqueConstraint(name="groupe_user_unique",
 *            columns={"groupe_id", "user_id"})
 *    }
 * )
 * @ORM\Table(name="rating")
 * @ORM\Entity(repositoryClass="Group\GroupBundle\Repository\RatingRepository")
 */
class Rating
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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="rating")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $userId;
    /**
     * @var integer
     *
     * @ORM\Column(name="rating",type="integer",nullable=true)
     */
    private $ratingValue;


    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Group\GroupBundle\Entity\Groupe", inversedBy="rating")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $groupId;


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
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     *
     * @return Rating
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get groupId.
     *
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Set groupId.
     *
     * @param int $groupId
     *
     * @return Rating
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return int
     */
    public function getRatingValue(): int
    {
        return $this->ratingValue;
    }

    /**
     * @param int $ratingValue
     */
    public function setRatingValue(int $ratingValue)
    {
        $this->ratingValue = $ratingValue;
    }


}
