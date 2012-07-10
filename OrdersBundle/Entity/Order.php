<?php
namespace Chewbacca\OrdersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *  @ORM\Table(name="chewb_orders")
 *
 **/
 class Order
 {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\UserBundle\Entity\User", inversedBy="orders", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\UserBundle\Entity\UserPhone", inversedBy="orders", cascade={"persist"})
     * @ORM\JoinColumn(name="phone_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $phone;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="total_items", type="integer")
     */
    protected $total_items = 0;

    /**
     * @var string $amount
     *
     * @ORM\Column(name="amount", type="decimal", scale=2)
     */
    protected $amount = 0.00;

    /**
     * @var boolean $closed
     * @ORM\Column(name="closed", type="boolean")
     */
    protected $closed = false;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\OrdersBundle\Entity\OrderItem", mappedBy="order", cascade={"all"})
     */
    protected $order_items;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\OrdersBundle\Entity\DeliveryAddress", inversedBy="orders", cascade={"persist"})
     * @ORM\JoinColumn(name="delivery_address_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $delivery_address;

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
     * @param  boolean $closed
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
     * @param  datetime $created
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
     * @param  datetime $updated
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

    /**
     * Set total_items
     *
     * @param  integer $totalItems
     * @return Order
     */
    public function setTotalItems($totalItems)
    {
        $this->total_items = $totalItems;

        return $this;
    }

    /**
     * Get total_items
     *
     * @return integer
     */
    public function getTotalItems()
    {
        return $this->total_items;
    }

    /**
     * Set amount
     *
     * @param  decimal $amount
     * @return Order
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return decimal
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set user
     *
     * @param  FOS\UserBundle\Model\User $user
     * @return Order
     */
    public function setUser(\FOS\UserBundle\Model\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return FOS\UserBundle\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }
    public function __construct()
    {
        $this->order_items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add order_items
     *
     * @param Chewbacca\OrdersBundle\Entity\OrderItem $orderItems
     */
    public function addOrderItem(\Chewbacca\OrdersBundle\Entity\OrderItem $orderItems)
    {
        $this->order_items[] = $orderItems;
        $orderItems->setOrder($this);
        $this->setTotalItems( $this->getTotalItems()+1);
        $this->setAmount($this->getAmount() + $orderItems->getPrice());
    }

    /**
     * Get order_items
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getOrderItems()
    {
        return $this->order_items;
    }

    /**
     * Set delivery_address
     *
     * @param  Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddress
     * @return Order
     */
    public function setDeliveryAddress(\Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddress = null)
    {
        $this->delivery_address = $deliveryAddress;

        return $this;
    }

    /**
     * Get delivery_address
     *
     * @return Chewbacca\OrdersBundle\Entity\DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->delivery_address;
    }

    /**
     * Set phone
     *
     * @param  Chewbacca\UserBundle\Entity\UserPhone $phone
     * @return Order
     */
    public function setPhone(\Chewbacca\UserBundle\Entity\UserPhone $phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return Chewbacca\UserBundle\Entity\UserPhone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Remove order_items
     *
     * @param Chewbacca\OrdersBundle\Entity\OrderItem $orderItems
     */
    public function removeOrderItem(\Chewbacca\OrdersBundle\Entity\OrderItem $orderItems)
    {
        $this->order_items->removeElement($orderItems);
    }
}