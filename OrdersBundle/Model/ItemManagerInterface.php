<?php

namespace Chewbacca\OrdersBundle\Model;

use Chewbacca\CartBundle\Entity\CartItem;

/**
 * Interface for order item model manager.
 *
 */
interface ItemManagerInterface
{
    /**
     * Returns FQCN of order item model.
     * 
     * @return string
     */
    function getClass();
    
    /**
     * Creates item model object.
     */
    function createItem(CartItem $cartItem);
    
    /**
     * Finds item by id.
     * 
     * @param integer $id
     */
    function findItem($id);
    
    /**
     * Finds item by criteria.
     * 
     * @param array $criteria
     */
    function findItemBy(array $criteria);
    
    /**
     * Finds all items.
     * 
     * @return array
     */
    function findItems();
    
    /**
     * Finds items by criteria.
     * 
     * @param array $criteria
     */
    function findItemsBy(array $criteria);
}