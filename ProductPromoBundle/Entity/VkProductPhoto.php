<?php
namespace Chewbacca\ProductPromoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 */

 class VkProductPhoto extends VkPhoto
 {
    /**
     * @ORM\OneToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductImage", inversedBy="vk_product_photo")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $product_image;

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $caption
     */
    protected $caption;

    /**
     * @var Chewbacca\ProductPromoBundle\Entity\VkPhotoAlbum
     */
    protected $vk_photo_album;

    /**
     * @var Chewbacca\CoreBundle\Entity\Image
     */
    protected $image;

    /**
     * @var integer $vk_pid
     */
    protected $vk_pid;

    /**
     * @var string $vk_id
     */
    protected $vk_id;

    /**
     * @var integer $vk_aid
     */
    protected $vk_aid;

    /**
     * @var integer $vk_owner_id
     */
    protected $vk_owner_id;

    /**
     * @var integer $vk_user_id
     */
    protected $vk_user_id;

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
     * @param  string         $title
     * @return VkProductPhoto
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
     * Set caption
     *
     * @param  string         $caption
     * @return VkProductPhoto
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set product_image
     *
     * @param  Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductImage $productImage
     * @return VkProductPhoto
     */
    public function setProductImage(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductImage $productImage = null)
    {
        $this->product_image = $productImage;

        return $this;
    }

    /**
     * Get product_image
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductImage
     */
    public function getProductImage()
    {
        return $this->product_image;
    }

    /**
     * Set vk_photo_album
     *
     * @param  Chewbacca\ProductPromoBundle\Entity\VkPhotoAlbum $vkPhotoAlbum
     * @return VkProductPhoto
     */
    public function setVkPhotoAlbum(\Chewbacca\ProductPromoBundle\Entity\VkPhotoAlbum $vkPhotoAlbum = null)
    {
        $this->vk_photo_album = $vkPhotoAlbum;

        return $this;
    }

    /**
     * Get vk_photo_album
     *
     * @return Chewbacca\ProductPromoBundle\Entity\VkPhotoAlbum
     */
    public function getVkPhotoAlbum()
    {
        return $this->vk_photo_album;
    }

    /**
     * Set image
     *
     * @param  Chewbacca\CoreBundle\Entity\Image $image
     * @return VkProductPhoto
     */
    public function setImage(\Chewbacca\CoreBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Chewbacca\CoreBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set vk_pid
     *
     * @param  integer        $vkPid
     * @return VkProductPhoto
     */
    public function setVkPid($vkPid)
    {
        $this->vk_pid = $vkPid;

        return $this;
    }

    /**
     * Get vk_pid
     *
     * @return integer
     */
    public function getVkPid()
    {
        return $this->vk_pid;
    }

    /**
     * Set vk_id
     *
     * @param  string         $vkId
     * @return VkProductPhoto
     */
    public function setVkId($vkId)
    {
        $this->vk_id = $vkId;

        return $this;
    }

    /**
     * Get vk_id
     *
     * @return string
     */
    public function getVkId()
    {
        return $this->vk_id;
    }

    /**
     * Set vk_aid
     *
     * @param  integer        $vkAid
     * @return VkProductPhoto
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
     * @param  integer        $vkOwnerId
     * @return VkProductPhoto
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
     * Set vk_user_id
     *
     * @param  integer        $vkUserId
     * @return VkProductPhoto
     */
    public function setVkUserId($vkUserId)
    {
        $this->vk_user_id = $vkUserId;

        return $this;
    }

    /**
     * Get vk_user_id
     *
     * @return integer
     */
    public function getVkUserId()
    {
        return $this->vk_user_id;
    }
}
