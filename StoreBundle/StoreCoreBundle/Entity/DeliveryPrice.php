<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 *  @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="search_idx", columns={"product_id", "delivery_type_id", "country_id"})})
 **/
 class DeliveryPrice{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product", inversedBy="delivery_prices", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\DeliveryType", cascade={"persist"})
     * @ORM\JoinColumn(name="delivery_type_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $delivery_type;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country", cascade={"persist"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $country;

    /**
     * @var string $price
     *
     * @ORM\Column(name="price", type="decimal")
     */
    protected $price;

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
     * Set product
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $product
     * @return DeliveryPrice
     */
    public function setProduct(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set delivery_type
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\DeliveryType $deliveryType
     * @return DeliveryPrice
     */
    public function setDeliveryType(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\DeliveryType $deliveryType = null)
    {
        $this->delivery_type = $deliveryType;
        return $this;
    }

    /**
     * Get delivery_type
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\DeliveryType 
     */
    public function getDeliveryType()
    {
        return $this->delivery_type;
    }

    /**
     * Set country
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country $country
     * @return DeliveryPrice
     */
    public function setCountry(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set price
     *
     * @param decimal $price
     * @return DeliveryPrice
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
}