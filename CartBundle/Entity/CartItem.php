<?php
namespace Chewbacca\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *
 **/
 class CartItem
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
     * @ORM\ManyToOne(targetEntity="\Chewbacca\CartBundle\Entity\Cart", inversedBy="cart_items", cascade={"persist"})
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $cart;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet", cascade={"persist"})
     * @ORM\JoinColumn(name="product_set_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $product_set;

    /**
     * @var integer $quantity
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity = 1;

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
     * Set cart
     *
     * @param  Chewbacca\CartBundle\Entity\Cart $cart
     * @return CartItem
     */
    public function setCart(\Chewbacca\CartBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return Chewbacca\CartBundle\Entity\Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set product_set
     *
     * @param  Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet $productSet
     * @return CartItem
     */
    public function setProductSet(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet $productSet)
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
     * Set quantity
     *
     * @param  integer  $quantity
     * @return CartItem
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

    public function incrementQuantity($amount = 1)
    {
        $this->quantity += $amount;
    }

    public function equals(CartItem $item)
    {
        return $this->getProductSet()->getId() === $item->getProductSet()->getId();
    }
}