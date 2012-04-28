<?php
namespace Chewbacca\OrdersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 *  @ORM\HasLifecycleCallbacks()
 *  @ORM\Table(name="chewb_order_items")
 * 
 **/
 class OrderItem{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\OrdersBundle\Entity\Order", inversedBy="order_items", cascade={"persist"})
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $order;

    /**
     * @var string $price
     *
     * @ORM\Column(name="price", type="decimal", scale=2)
     */
    protected $price;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", unique=true, length=255)
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet", cascade={"persist"})
     * @ORM\JoinColumn(name="product_set_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $product_set;

    /**
     * @var integer $quantity
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;


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
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set order
     *
     * @param Chewbacca\OrdersBundle\Entity\Order $order
     * @return OrderItem
     */
    public function setOrder(\Chewbacca\OrdersBundle\Entity\Order $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return Chewbacca\OrdersBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product_set
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet $productSet
     * @return OrderItem
     */
    public function setProductSet(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet $productSet = null)
    {
        $this->product_set = $productSet;
        return $this;
    }

    /**
     * Get product_set
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet 
     */
    public function getProductSet()
    {
        return $this->product_set;
    }

    /**
     * Set price
     *
     * @param decimal $price
     * @return OrderItem
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return decimal 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return OrderItem
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
}