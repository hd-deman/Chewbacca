<?php
namespace Chewbacca\OrdersBundle\Model;

/**
 * Abstract order manager class.
 *
 */
abstract class OrderManager implements OrderManagerInterface
{
    /**
     * Order class.
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
     * Returns FQCN of order.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
