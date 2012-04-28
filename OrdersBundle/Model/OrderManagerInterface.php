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
    function createOrder(Cart $cart);
    /**
     * Persist order.
     * 
     * @param Order
     */
    function persistOrder(Order $order);
    
    /**
     * Removes order.
     * 
     * @param Order $order
     */
    function removeOrder(Order $order);
    
    /**
     * Finds order by id.
     * 
     * @param integer $id
     * @return Order
     */
    function findOrder($id);
    
    /**
     * Finds order by criteria.
     * 
     * @param array $criteria
     * @return Order
     */
    function findOrderBy(array $criteria);
    
    /**
     * Finds all orders.
     * 
     * @return array
     */
    function findOrders();
    
    /**
     * Finds orders by criteria.
     * 
     * @param array $criteria
     * @return array
     */
    function findOrdersBy(array $criteria);
    
    /**
     * Returns FQCN of order.
     * 
     * @return string
     */
    function getClass();
}