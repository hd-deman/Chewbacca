<?php
namespace Chewbacca\ProductPromoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *
 **/
 class VkBrandPhotoAlbum  extends VkPhotoAlbum
 {
    /**
     * @ORM\OneToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand", inversedBy="vk_photo_album")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $brand;
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var integer $vk_aid
     */
    protected $vk_aid;

    /**
     * @var integer $vk_owner_id
     */
    protected $vk_owner_id;

    /**
     * @var integer $vk_size
     */
    protected $vk_size;

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
     * @param  string            $title
     * @return VkBrandPhotoAlbum
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
     * @param  string            $description
     * @return VkBrandPhotoAlbum
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
     * Set vk_aid
     *
     * @param  integer           $vkAid
     * @return VkBrandPhotoAlbum
     */
    public function setVkAid($vkAid)
    {
        $this->vk_aid = $vkAid;

        return $this;
    }

    /**
     * Get vk_aid
     *
     * @return integer
     */
    public function getVkAid()
    {
        return $this->vk_aid;
    }

    /**
     * Set vk_owner_id
     *
     * @param  integer           $vkOwnerId
     * @return VkBrandPhotoAlbum
     */
    public function setVkOwnerId($vkOwnerId)
    {
        $this->vk_owner_id = $vkOwnerId;

        return $this;
    }

    /**
     * Get vk_owner_id
     *
     * @return integer
     */
    public function getVkOwnerId()
    {
        return $this->vk_owner_id;
    }

    /**
     * Set vk_size
     *
     * @param  integer           $vkSize
     * @return VkBrandPhotoAlbum
     */
    public function setVkSize($vkSize)
    {
        $this->vk_size = $vkSize;

        return $this;
    }

    /**
     * Get vk_size
     *
     * @return integer
     */
    public function getVkSize()
    {
        return $this->vk_size;
    }

    /**
     * Set brand
     *
     * @param  Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand $brand
     * @return VkBrandPhotoAlbum
     */
    public function setBrand(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Brand $brand = null)
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $vk_photos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vk_photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vk_photos
     *
     * @param  Chewbacca\ProductPromoBundle\Entity\VkPhoto $vkPhotos
     * @return VkBrandPhotoAlbum
     */
    public function addVkPhoto(\Chewbacca\ProductPromoBundle\Entity\VkPhoto $vkPhotos)
    {
        $this->vk_photos[] = $vkPhotos;

        return $this;
    }

    /**
     * Remove vk_photos
     *
     * @param Chewbacca\ProductPromoBundle\Entity\VkPhoto $vkPhotos
     */
    public function removeVkPhoto(\Chewbacca\ProductPromoBundle\Entity\VkPhoto $vkPhotos)
    {
        $this->vk_photos->removeElement($vkPhotos);
    }

    /**
     * Get vk_photos
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getVkPhotos()
    {
        return $this->vk_photos;
    }
}
