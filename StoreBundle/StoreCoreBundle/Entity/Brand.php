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
 *  @ORM\DiscriminatorMap({"brand" = "Brand", "mltd_brand" = "Lacroco\StoreBundle\Entity\MltdBrand"})
 **/
 class Brand
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
     * @Gedmo\Slug(fields={"title"}, unique=true)
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product", mappedBy="brand")
     */
    protected $products;

    /**
     * @ORM\OneToOne(targetEntity="\Chewbacca\ProductPromoBundle\Entity\VkBrandPhotoAlbum", mappedBy="brand")
     */
    protected $vk_photo_album;

    public function __toString()
    {
        return $this->getTitle();
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
     * Set created
     *
     * @param  datetime $created
     * @return Brand
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
     * @return Brand
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
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add products
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products
     */
    public function addProduct(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products)
    {
        $this->products[] = $products;
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

    /**
     * Set title
     *
     * @param  string $title
     * @return Brand
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
     * Set slug
     *
     * @param  string $slug
     * @return Brand
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
     * Remove products
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products
     */
    public function removeProduct(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Set vk_photo_album
     *
     * @param  Chewbacca\ProductPromoBundle\Entity\VkBrandPhotoAlbum $vkPhotoAlbum
     * @return Brand
     */
    public function setVkPhotoAlbum(\Chewbacca\ProductPromoBundle\Entity\VkBrandPhotoAlbum $vkPhotoAlbum = null)
    {
        $this->vk_photo_album = $vkPhotoAlbum;

        return $this;
    }

    /**
     * Get vk_photo_album
     *
     * @return Chewbacca\ProductPromoBundle\Entity\VkBrandPhotoAlbum
     */
    public function getVkPhotoAlbum()
    {
        return $this->vk_photo_album;
    }
}
