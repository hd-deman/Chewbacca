<?php

namespace Chewbacca\CartBundle\Model;

/**
 * Base class for cart item model manager.
 *
 */
abstract class ItemManager implements ItemManagerInterface
{
    /**
     * FQCN for cart item model.
     *
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param string $class The FQCN for cart item model
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