<?php
namespace Chewbacca\ProductPromoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *  @ORM\InheritanceType("SINGLE_TABLE")
 *  @ORM\DiscriminatorColumn(name="discr", type="string")
 *  @ORM\DiscriminatorMap({"vk_photo" = "VkPhoto", "vk_product_photo" = "VkProductPhoto"})
 */

 class VkPhoto
 {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $vk_pid
     *
     * @ORM\Column(name="vk_pid", type="integer")
     */
     protected $vk_pid;

    /**
     * @var string $vk_id
     *
     * @ORM\Column(name="vk_id", type="string")
     */
     protected $vk_id;

    /**
     * @var integer $vk_aid
     * @ORM\Column(name="vk_aid", type="integer")
     */
     protected $vk_aid;

    /**
     * @var integer $vk_owner_id
     * @ORM\Column(name="vk_owner_id", type="integer")
     */
     protected $vk_owner_id;

    /**
     * @ORM\Column(name="vk_user_id", type="integer")
     */
     protected $vk_user_id;

    /**
     * @var string $caption
     *
     * @ORM\Column(name="caption", type="string", nullable=false)
     */
    protected $caption;

    /**
     * @ORM\ManyToOne(targetEntity="VkPhotoAlbum", inversedBy="vk_photos")
     * @ORM\JoinColumn(name="vk_photo_album_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $vk_photo_album;

    /**
     * @ORM\OneToOne(targetEntity="\Chewbacca\CoreBundle\Entity\Image", inversedBy="vk_photo")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $image;

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
     * @param  string  $title
     * @return VkPhoto
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
     * @param  string  $caption
     * @return VkPhoto
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
     * Set vk_photo_album
     *
     * @param  Chewbacca\ProductPromoBundle\Entity\VkPhotoAlbum $vkPhotoAlbum
     * @return VkPhoto
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
     * @return VkPhoto
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
     * @param  integer $vkPid
     * @return VkPhoto
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
     * @param  string  $vkId
     * @return VkPhoto
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
     * @param  integer $vkAid
     * @return VkPhoto
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
     * @param  integer $vkOwnerId
     * @return VkPhoto
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
     * @param  integer $vkUserId
     * @return VkPhoto
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
