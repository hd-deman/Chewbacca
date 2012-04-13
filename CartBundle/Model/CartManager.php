<?php

namespace Chewbacca\CartBundle\Model;

/**
 * Base class for cart model manager.
 *
 */
abstract class CartManager implements CartManagerInterface
{
    /**
     * FQCN of cart model.
     *
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param string $class FQCN of cart model
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}
