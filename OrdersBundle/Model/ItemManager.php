<?php

namespace Chewbacca\OrdersBundle\Model;

/**
 * Base class for order item model manager.
 *
 */
abstract class ItemManager implements ItemManagerInterface
{
    /**
     * FQCN for order item model.
     *
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param string $class The FQCN for order item model
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
