<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 **/
 class Country{
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
     * @ORM\Column(name="title", type="string", unique=true, length=120)
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\OrdersBundle\Entity\DeliveryAddress", mappedBy="country", cascade={"all"})
     */
    protected $delivery_addresses;
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
     * @return Country
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
    public function __construct()
    {
        $this->delivery_addresses = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add delivery_addresses
     *
     * @param Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddresses
     */
    public function addDeliveryAddress(\Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddresses)
    {
        $this->delivery_addresses[] = $deliveryAddresses;
    }

    /**
     * Get delivery_addresses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDeliveryAddresses()
    {
        return $this->delivery_addresses;
    }

    /**
     * Add delivery_addresses
     *
     * @param Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddresses
     * @return Country
     */
    public function addDeliveryAddresse(\Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddresses)
    {
        $this->delivery_addresses[] = $deliveryAddresses;
        return $this;
    }
}