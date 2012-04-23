<?php

namespace Chewbacca\OrdersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chewbacca\OrdersBundle\Entity\Status
 *
 * @ORM\Table(name="chewb_order_statuses")
 * @ORM\Entity
 */
class Status
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Status title.
     *
     * @var string $title
	 * 
	 * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * Position in the status list.
     *
     * @var integer $position
	 * 
	 * @ORM\Column(name="position", type="integer")
     */
    protected $position;



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
     * Set title
     *
     * @param string $title
     * @return Status
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
     * Set position
     *
     * @param integer $position
     * @return Status
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}