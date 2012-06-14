<?php

namespace Chewbacca\CartBundle\Operator;

use Chewbacca\CartBundle\Entity\Cart;
use Chewbacca\CartBundle\Entity\CartItem;

/**
 * Interface for cart operator.
 *
 */
interface CartOperatorInterface
{
    /**
     * Adds item to cart.
     *
     * @param Cart     $cart
     * @param CartItem $item
     */
    public function addItem(Cart $cart, CartItem $item);

    /**
     * Removes item from cart.
     *
     * @param Cart     $cart
     * @param CartItem $item
     */
    public function removeItem(Cart $cart, CartItem $item);

    /**
     * Refreshes cart data.
     *
     * @param Cart $cart
     */
    public function refresh(Cart $cart);

    /**
     * Saves cart at current state.
     *
     * @param Cart $cart
     */
    public function save(Cart $cart);

    /**
     * Clears current cart.
     *
     * @param Cart $cart
     */
    public function clear(Cart $cart);
}
