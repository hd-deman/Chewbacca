<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/** 
 *  @ORM\Entity 
 *  @ORM\InheritanceType("SINGLE_TABLE")
 *  @ORM\DiscriminatorColumn(name="discr", type="string")
 *  @ORM\DiscriminatorMap({"brand" = "Brand", "mltd_brand" = "Acme\Lacroco\StoreBundle\Entity\MltdBrand"})
 **/
 class Brand{
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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

}

