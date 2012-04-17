<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Model;

/**
 * Manages product sets.
 *
 */
abstract class ProductSetManager implements ProductSetManagerInterface
{
    /**
     * Product Set class.
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