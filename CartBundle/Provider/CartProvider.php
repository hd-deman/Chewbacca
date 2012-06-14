<?php

namespace Chewbacca\CartBundle\Provider;

use Chewbacca\CartBundle\Entity\Cart;
use Chewbacca\CartBundle\Model\CartManagerInterface;
use Chewbacca\CartBundle\Storage\CartStorageInterface;

/**
 * Default provider cart.
 *
 */
class CartProvider implements CartProviderInterface
{
    /**
     * Cart identifier storage.
     *
     * @var CartStorageInterface
     */
    protected $storage;

    /**
     * Cart manager.
     *
     * @var CartManagerInterface
     */
    protected $cartManager;

    /**
     * Cart.
     *
     * @var CartInterface
     */
    protected $cart;

    /**
     * Constructor.
     *
     * @param CartStorageInterface $storage
     * @param CartManagerInterface $cartManager
     */
    public function __construct(CartStorageInterface $storage, CartManagerInterface $cartManager)
    {
        $this->storage = $storage;
        $this->cartManager = $cartManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart($with_items = false)
    {
        if (null == $this->cart) {
            $cartIdentifier = $this->storage->getCurrentCartIdentifier();

            if ($cartIdentifier) {
                if ($with_items) {
                    $cart = $this->cartManager->findCartWithItems($cartIdentifier);
                 } else {
                    $cart = $this->cartManager->findCart($cartIdentifier);
                 }

                if ($cart) {
                    $this->cart = $cart;

                    return $cart;
                }
            }

            $cart = $this->cartManager->createCart();
            $this->cartManager->persistCart($cart);
            $this->storage->setCurrentCartIdentifier($cart);

            $this->cart = $cart;
        }

        return $this->cart;
    }

    /**
     * {@inheritdoc}
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
        $this->storage->setCurrentCartIdentifier($cart);
    }
}
