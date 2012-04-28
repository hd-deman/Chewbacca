<?php
namespace Chewbacca\OrdersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 *  @ORM\HasLifecycleCallbacks()
 *  @ORM\Table(name="chewb_delivery_address")
 * 
 **/
 class DeliveryAddress{
    /**
     * Firstname.
     *
	 * @var string $firstname
     * @ORM\Column(name="firstname", type="string", length=120)
     */
    protected $firstname;

    /**
     * Lastname.
     *
	 * @var string $lastname
     * @ORM\Column(name="lastname", type="string", length=120)
     */
    protected $lastname;

    /**
     * Street.
     *
     * @var string
     */
    protected $street;

    /**
     * City.
     *
     * @var string
     */
    protected $city;

    /**
     * Postcode.
     *
     * @var string
     */
    protected $postcode;

    /**
     * @var datetime $created
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;
