<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *
 *  @ORM\InheritanceType("SINGLE_TABLE")
 *  @ORM\DiscriminatorColumn(name="discr", type="string")
 *  @ORM\DiscriminatorMap({"product" = "Product", "mltd_product" = "\Lacroco\StoreBundle\Entity\MltdProduct"})
 **/
 class Product{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;#

    /**
     * @var string $title
	 *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string $price
     *
     * @ORM\Column(name="price", type="decimal", scale=2)
     */
    protected $price;

    /**
     * @var string $sale_price
     *
     * @ORM\Column(name="sale_price", type="decimal", scale=2)
     */
    protected $sale_price = 0;

    /**
     * @Gedmo\Slug(fields={"title", "id"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand", inversedBy="products")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $brand;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\ExchangeRatesBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $currency;


    /**
     * @ORM\ManyToMany(targetEntity="\Chewbacca\CoreBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinTable(name="products_categories",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    protected $categories;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet", mappedBy="product")
     */
    protected $product_sets;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductImage", mappedBy="product")
	 * @ORM\OrderBy({"priority" = "ASC"})
     */
    protected $product_images;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\DeliveryPrice", mappedBy="product")
     */
    protected $delivery_prices;

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
     public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
		$this->product_sets = new \Doctrine\Common\Collections\ArrayCollection();
		$this->product_images = new \Doctrine\Common\Collections\ArrayCollection();
		$this->cart_items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set price
     *
     * @param decimal $price
     * @return Product
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
     * Set sale_price
     *
     * @param decimal $salePrice
     * @return Product
     */
    public function setSalePrice($salePrice)
    {
        $this->sale_price = $salePrice;
        return $this;
    }

    /**
     * Get sale_price
     *
     * @return decimal
     */
    public function getSalePrice()
    {
        return $this->sale_price;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Product
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
     * @return Product
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
     * Set brand
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand $brand
     * @return Product
     */
    public function setBrand(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand $brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * Get brand
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Add categories
     *
     * @param Chewbacca\CoreBundle\Entity\Category $categories
     */
    public function addCategory(\Chewbacca\CoreBundle\Entity\Category $categories)
    {
        $this->categories[$categories->getId()] = $categories;
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
     * Add cart_items
     *
     * @param Chewbacca\CartBundle\Entity\CartItem $cartItems
     */
    public function addCartItem(\Chewbacca\CartBundle\Entity\CartItem $cartItem)
    {
        $this->cart_items[] = $cartItem;
    }

    /**
     * Get cart_items
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getCartItems()
    {
        return $this->cart_items;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Product
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
     * Add product_sets
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet $productSets
     */
    public function addProductSet(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet $productSets)
    {
        $this->product_sets[] = $productSets;
    }

    /**
     * Get product_sets
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getProductSets()
    {
        return $this->product_sets;
    }

    /**
     * Add product_images
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductImage $productImages
     */
    public function addProductImage(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductImage $productImages)
    {
        $this->product_images[] = $productImages;
    }

    /**
     * Get product_images
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getProductImages()
    {
        return $this->product_images;
    }

    /**
     * Add delivery_prices
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\DeliveryPrice $deliveryPrices
     */
    public function addDeliveryPrice(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\DeliveryPrice $deliveryPrices)
    {
        $this->delivery_prices[] = $deliveryPrices;
    }

    /**
     * Get delivery_prices
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getDeliveryPrices()
    {
        return $this->delivery_prices;
    }

	public function getStorePrice(){
		if($this->delivery_prices && $this->currency){
            $add1 = 49;
            $add2 = 99;
            $myup = ($this->getPrice()/100)*20;
            $store_price = ceil(($this->getPrice()+$this->delivery_prices[0]->getPrice()+$myup)*$this->currency->getRate());
            $price_o = $store_price%100;
            $price_v = $store_price-$price_o;
            if($price_o<50){
                $price_o = 100+$add1;
            }else{
                $price_o = 100+$add2;
            }
            $store_price = $price_v+$price_o;
           # echo 'price: '.$this->getPrice()*$this->currency->getRate().' ('.$this->getPrice().')';
           # echo 'delivery price: '.$this->delivery_prices[0]->getPrice()*$this->currency->getRate().' ('.$this->delivery_prices[0]->getPrice().')';
           # echo 'no extra price: '.($this->delivery_prices[0]->getPrice()+$this->getPrice())*$this->currency->getRate().' ('.$this->getPrice()+$this->delivery_prices[0]->getPrice().')';
            return $store_price;
		}else{
			//@TODO throw exception
			return false;
		}
	}

    /**
     * Set currency
     *
     * @param Chewbacca\ExchangeRatesBundle\Entity\Currency $currency
     * @return Product
     */
    public function setCurrency(\Chewbacca\ExchangeRatesBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Get currency
     *
     * @return Chewbacca\ExchangeRatesBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}