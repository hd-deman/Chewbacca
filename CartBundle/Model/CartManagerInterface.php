<?php

namespace Chewbacca\CartBundle\Model;
use Chewbacca\CartBundle\Entity\Cart;

/**
 * Interface for cart manager.
 *
 */
interface CartManagerInterface
{
/* }}} */
    /**
     * Creates a new cart instance.
     *
     * @return CartInterface
     */
    function createCart();

    /**
     * Persists cart object.
     *
     * @param CartInterface $cart
     */
    function persistCart(Cart $cart);

    /**
     * Removes cart object.
     *
     * @param CartInterface $cart
     */
    function removeCart(Cart $cart);

    /**
     * Removes all saved carts that are expired.
     */
    function flushCarts();

    /**
     * Finds cart by id.
     *
     * @param $id
     *
     * @return CartInterface|null
     */
    function findCart($id);

    /**
     * Finds cart by given criteria.
     *
     * @param array $criteria
     */
    function findCartBy(array $criteria);

    /**
     * Finds all carts.
     *
     * @return array
     */
    function findCarts();

    /**
     * Finds carts by criteria.
     *
     * @param array $criteria
     */
    function findCartsBy(array $criteria);

    /**
     * Returns FQCN of cart model.
     *
     * @return string
     */
    function getClass();
}
