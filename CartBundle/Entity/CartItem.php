<?php
namespace Chewbacca\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 *  @ORM\HasLifecycleCallbacks()
 * 
 **/
 class CartItem{
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
     * @param Chewbacca\CartBundle\Entity\Cart $cart
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
}