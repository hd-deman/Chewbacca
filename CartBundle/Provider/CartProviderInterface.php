<?php

namespace Chewbacca\CartBundle\Provider;

use Chewbacca\CartBundle\Entity\Cart;

/**
 * Interface for object that is accessor for cart.
 * It should retrieve existing cart or create new one based on storage.
 *
 */
interface CartProviderInterface
{
    /**
     * Returns current cart.
     * If none found is by storage, it should create new one and save it.
     *
     * @return CartInterface
     */
    public function getCart();

    /**
     * Sets given cart as current one.
     * Also should update storage if any is used.
     *
     * @param CartInterface $cart
     */
    public function setCart(Cart $cart);
}
