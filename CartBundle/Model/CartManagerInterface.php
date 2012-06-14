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
    public function createCart();

    /**
     * Persists cart object.
     *
     * @param CartInterface $cart
     */
    public function persistCart(Cart $cart);

    /**
     * Removes cart object.
     *
     * @param CartInterface $cart
     */
    public function removeCart(Cart $cart);

    /**
     * Removes all saved carts that are expired.
     */
    public function flushCarts();

    /**
     * Finds cart by id.
     *
     * @param $id
     *
     * @return CartInterface|null
     */
    public function findCart($id);

    /**
     * Finds cart by given criteria.
     *
     * @param array $criteria
     */
    public function findCartBy(array $criteria);

    /**
     * Finds all carts.
     *
     * @return array
     */
    public function findCarts();

    /**
     * Finds carts by criteria.
     *
     * @param array $criteria
     */
    public function findCartsBy(array $criteria);

    /**
     * Returns FQCN of cart model.
     *
     * @return string
     */
    public function getClass();
}
