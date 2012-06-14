<?php

namespace Chewbacca\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 */

 class Nature
 {
    public function __toString()
    {
        return $this->title;
    }
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;#

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\CoreBundle\Entity\Category", mappedBy="nature")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  intager $id
     * @return Nature
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set title
     *
     * @param  string $title
     * @return Nature
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
     * Add categories
     *
     * @param Chewbacca\CoreBundle\Entity\Category $categories
     */
    public function addCategory(\Chewbacca\CoreBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add categories
     *
     * @param  Chewbacca\CoreBundle\Entity\Category $categories
     * @return Nature
     */
    public function addCategorie(\Chewbacca\CoreBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }
}
