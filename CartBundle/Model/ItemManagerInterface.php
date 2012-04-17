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
    function getClass();

    /**
     * Creates item model object.
     */
    function createItem();

    /**
     * Persists item.
     *
     * @param CartItem $item
     */
    function persistItem(CartItem $item);

    /**
     * Removes item.
     *
     * @param CartItem $item
     */
    function removeItem(CartItem $item);

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