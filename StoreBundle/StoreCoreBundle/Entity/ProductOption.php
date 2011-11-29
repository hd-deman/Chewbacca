<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 **/
 class ProductOption{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=120)
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet", mappedBy="product_option")
     */
    protected $product_sets;

    public function __construct()
    {
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
     * Set title
     *
     * @param string $title
     * @return ProductOption
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
}