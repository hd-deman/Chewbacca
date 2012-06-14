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
    public function getClass();

    /**
     * Creates item model object.
     */
    public function createItem(CartItem $cartItem);

    /**
     * Finds item by id.
     *
     * @param integer $id
     */
    public function findItem($id);

    /**
     * Finds item by criteria.
     *
     * @param array $criteria
     */
    public function findItemBy(array $criteria);

    /**
     * Finds all items.
     *
     * @return array
     */
    public function findItems();

    /**
     * Finds items by criteria.
     *
     * @param array $criteria
     */
    public function findItemsBy(array $criteria);
}
