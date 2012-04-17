<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Model;

/**
 * Assortment manager.
 * Manages products.
 *
 */
abstract class ProductManager implements ProductManagerInterface
{
    /**
     * Product class.
     *
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @var string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Returns FQCN of product.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}