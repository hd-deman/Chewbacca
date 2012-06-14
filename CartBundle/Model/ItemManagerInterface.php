<?php

namespace Chewbacca\CartBundle\Model;

use Chewbacca\CartBundle\Entity\CartItem;

/**
 * Interface for cart intem model manager.
 *
 */
interface ItemManagerInterface
{
    /**
     * Returns FQCN of cart item model.
     *
     * @return string
     */
    public function getClass();

    /**
     * Creates item model object.
     */
    public function createItem();

    /**
     * Persists item.
     *
     * @param CartItem $item
     */
    public function persistItem(CartItem $item);

    /**
     * Removes item.
     *
     * @param CartItem $item
     */
    public function removeItem(CartItem $item);

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
