<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/** 
 *  @ORM\Entity 
 *  @ORM\InheritanceType("SINGLE_TABLE")
 *  @ORM\DiscriminatorColumn(name="discr", type="string")
 *  @ORM\DiscriminatorMap({"product" = "Product", "mltd_product" = "Acme\Lacroco\StoreBundle\Entity\MltdProduct"})
 **/
 class Product{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;#

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string $price
     *
     * @ORM\Column(name="price", type="decimal")
     */
    protected $price;

    /**
     * @var string $sale_price
     *
     * @ORM\Column(name="sale_price", type="decimal")
     */
    protected $sale_price;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string")
     */
    protected $description;
 }