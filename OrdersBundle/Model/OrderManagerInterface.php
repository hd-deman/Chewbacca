<?php

namespace Chewbacca\OrdersBundle\Model;

use Chewbacca\OrdersBundle\Entity\Order;
use Chewbacca\CartBundle\Entity\Cart;

/**
 * Order manager interface.
 *
 */
interface OrderManagerInterface
{
    /**
     * Creates new order object.
     *
     * @return Order
     */
    public function createOrder(Cart $cart);
    /**
     * Persist order.
     *
     * @param Order
     */
    public function persistOrder(Order $order);

    /**
     * Removes order.
     *
     * @param Order $order
     */
    public function removeOrder(Order $order);

    /**
     * Finds order by id.
     *
     * @param  integer $id
     * @return Order
     */
    public function findOrder($id);

    /**
     * Finds order by criteria.
     *
     * @param  array $criteria
     * @return Order
     */
    public function findOrderBy(array $criteria);

    /**
     * Finds all orders.
     *
     * @return array
     */
    public function findOrders();

    /**
     * Finds orders by criteria.
     *
     * @param  array $criteria
     * @return array
     */
    public function findOrdersBy(array $criteria);

    /**
     * Returns FQCN of order.
     *
     * @return string
     */
    public function getClass();
}
