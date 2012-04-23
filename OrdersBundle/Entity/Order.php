<?php
namespace Chewbacca\OrdersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 *  @ORM\HasLifecycleCallbacks()
 *  @ORM\Table(name="chewb_orders")
 * 
 **/
 class Order{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean $closed
     * @ORM\Column(name="closed", type="boolean")
     */
    protected $closed = false;

    /**
     * @var datetime $created
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;
	/**
	 * @ORM\prePersist
	 */
	public function setCreatedValue()
	{
	    $this->created = new \DateTime();
	}

    /**
     * @var datetime $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    protected $updated;
	/**
	 * @ORM\preUpdate
	 */
	public function setUpdatedValue()
	{
	    $this->updated = new \DateTime();
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
     * Set closed
     *
     * @param boolean $closed
     * @return Order
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean 
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Order
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return Order
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}