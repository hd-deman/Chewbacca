<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Chewbacca\CoreBundle\Entity\Image as Image;

/**
 *  @ORM\Entity
 *
 **/
 class ProductImage extends Image
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
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product", inversedBy="product_images")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $product;

    /**
     * @var integer $priority
     *
     * @ORM\Column(name="priority", type="integer")
     */
    protected $priority;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'data_files/product_images';
    }

    /**
     * Set product
     *
     * @param  Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $product
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
     * @var string $name
     */
    protected $name;

    /**
     * @var datetime $created
     */
    protected $created;

    /**
     * @var datetime $updated
     */
    protected $updated;

    /**
     * @var string $path
     */
    protected $path;

    /**
     * Set name
     *
     * @param  string       $name
     * @return ProductImage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set created
     *
     * @param  datetime     $created
     * @return ProductImage
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
     * @param  datetime     $updated
     * @return ProductImage
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
     * Set path
     *
     * @param  string       $path
     * @return ProductImage
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * @var string $title
     */
    protected $title;

    /**
     * Set title
     *
     * @param  string       $title
     * @return ProductImage
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
     * Set priority
     *
     * @param  integer      $priority
     * @return ProductImage
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }
}
