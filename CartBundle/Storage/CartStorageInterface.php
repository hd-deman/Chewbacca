<?php

namespace Chewbacca\CartBundle\Storage;

use Chewbacca\CartBundle\Entity\Cart;

/**
 * Interface for service that stores current cart id.
 *
 */
interface CartStorageInterface
{
    /**
     * Returns current cart id, used then to retrieve the cart.
     *
     * @return mixed
     */
    public function getCurrentCartIdentifier();

    /**
     * Sets current cart id and persists it.
     *
     * @param CartInterface $cart
     */
    public function setCurrentCartIdentifier(Cart $cart);
}
