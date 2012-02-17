<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity
 *  @Table(uniqueConstraints={@UniqueConstraint(name="search_idx", columns={"product_id", "size_id", "option_id"})})
 * 
 **/
 class ProductSet{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product", inversedBy="product_sets", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSize", inversedBy="product_sets", cascade={"persist"})
     * @ORM\JoinColumn(name="size_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $product_size;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductOption", inversedBy="product_sets", cascade={"persist"})
     * @ORM\JoinColumn(name="option_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $product_option;

    /**
     * @var integer $stock
     *
     * @ORM\Column(name="stock", type="integer")
     */
	protected $stock;

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
     * @return Set
     */
    public function setProduct(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $product)
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
     * Set product_size
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSize $productSize
     * @return ProductSet
     */
    public function setProductSize(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSize $productSize)
    {
        $this->product_size = $productSize;
        return $this;
    }

    /**
     * Get product_size
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSize 
     */
    public function getProductSize()
    {
        return $this->product_size;
    }

    /**
     * Set product_option
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductOption $productOption
     * @return ProductSet
     */
    public function setProductOption(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductOption $productOption)
    {
        $this->product_option = $productOption;
        return $this;
    }

    /**
     * Get product_option
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductOption 
     */
    public function getProductOption()
    {
        return $this->product_option;
    }

    /**
     * Set products
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products
     * @return ProductSet
     */
    public function setProducts(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * Get products
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return ProductSet
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }
}