<?php

namespace Chewbacca\ExchangeRatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *
 **/
 class Currency
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
     * @ORM\Column(name="mnemo", type="string", length=3)
     */
    protected $mnemo;

    /**
     * @var string $rate
     *
     * @ORM\Column(name="rate", type="decimal", scale=4)
     */
    protected $rate;

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
     * Set mnemo
     *
     * @param  string   $mnemo
     * @return Currency
     */
    public function setMnemo($mnemo)
    {
        $this->mnemo = $mnemo;

        return $this;
    }

    /**
     * Get mnemo
     *
     * @return string
     */
    public function getMnemo()
    {
        return $this->mnemo;
    }

    /**
     * Set rate
     *
     * @param  decimal  $rate
     * @return Currency
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return decimal
     */
    public function getRate()
    {
        return $this->rate;
    }
}