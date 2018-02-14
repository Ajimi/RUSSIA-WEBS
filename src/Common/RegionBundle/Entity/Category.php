<?php

namespace Common\RegionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Common\RegionBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255 ,nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="icon_type", type="string", length=255,nullable=true)
     */
    private $iconType;


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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Category
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get iconType
     *
     * @return string
     */
    public function getIconType()
    {
        return $this->iconType;
    }

    /**
     * Set iconType
     *
     * @param string $iconType
     *
     * @return Category
     */
    public function setIconType($iconType)
    {
        $this->iconType = $iconType;

        return $this;
    }


    /**
     * @param $item
     * @return Category
     */
    public static function fromJson($item): Category
    {
        $category = new Category();
        $category->setName($item['name']);
        $category->setCode($item['code']);
        $category->setIconType($item['icon_type']);

        return $category;
    }
}

