<?php
namespace Chewbacca\ProductPromoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"album" = "VkPhotoAlbum", "brand_album" = "VkBrandPhotoAlbum"}) *
 */

 class VkPhotoAlbum
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
     * @var integer $vk_aid
     *
     * @ORM\Column(name="vk_aid", type="integer", nullable=false)
     */
    protected $vk_aid;

    /**
     * @var integer $vk_owner_id
     *
     * @ORM\Column(name="vk_owner_id", type="integer", nullable=false)
     */
    protected $vk_owner_id;

    /**
     * @var integer $vk_size
     *
     * @ORM\Column(name="vk_size", type="integer", nullable=false)
     */
    protected $vk_size;

    /**
     * @ORM\OneToMany(targetEntity="VkPhoto", mappedBy="vk_photo_album")
     */
    protected $vk_photos
    ;
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
     * @return VkPhotoAlbum
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
     * @return VkPhotoAlbum
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
     * @param  integer      $vkAid
     * @return VkPhotoAlbum
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
     * @param  integer      $vkOwnerId
     * @return VkPhotoAlbum
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
     * @param  integer      $vkSize
     * @return VkPhotoAlbum
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
     * @return VkPhotoAlbum
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
