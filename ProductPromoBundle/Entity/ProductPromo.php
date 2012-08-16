<?php
namespace Chewbacca\ProductPromoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *
 *  @ORM\InheritanceType("SINGLE_TABLE")
 **/
 class ProductPromo
 {
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
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product")
     * @ORM\JoinTable(name="products_productPromos",
     *      joinColumns={@ORM\JoinColumn(name="promo_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    protected $products;
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  string       $title
     * @return ProductPromo
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
     * Set description
     *
     * @param  string       $description
     * @return ProductPromo
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
     * Add products
     *
     * @param  Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products
     * @return ProductPromo
     */
    public function addProduct(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products
     */
    public function removeProduct(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
