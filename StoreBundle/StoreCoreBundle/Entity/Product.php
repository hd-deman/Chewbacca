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
 *  @ORM\DiscriminatorMap({"product" = "Product", "mltd_product" = "Acme\Lacroco\StoreBundle\Entity\MltdProduct"})
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
     * @ORM\Column(name="price", type="decimal")
     */
    protected $price;

    /**
     * @var string $sale_price
     *
     * @ORM\Column(name="sale_price", type="decimal")
     */
    protected $sale_price = 0;

    /**
     * @Gedmo\Slug(fields={"title"}, unique=true)
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
     * @ORM\ManyToOne(targetEntity="Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand", inversedBy="products")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $brand;

    /**
     * @ORM\ManyToMany(targetEntity="Chewbacca\CoreBundle\Entity\Category", inversedBy="products")
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
     * Add sets
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Set $sets
     */
    public function addSet(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Set $sets)
    {
        $this->sets[] = $sets;
    }

    /**
     * Get sets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSets()
    {
        return $this->sets;
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
}