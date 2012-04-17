<?php

namespace Chewbacca\CartBundle\Operator;

use Chewbacca\CartBundle\Entity\Cart;
use Chewbacca\CartBundle\Model\CartManagerInterface;
use Chewbacca\CartBundle\Entity\CartItem;

/**
 * Base class for cart operator.
 * Sensible defaults for most common cart solutions.
 * Can be overriden to fit exact needs.
 *
 */
abstract class BaseCartOperator implements CartOperatorInterface
{
    /**
     * Cart manager.
     *
     * @var CartManagerInterface
     */
    protected $cartManager;

    /**
     * Constructor.
     *
     * @param CartManagerInterface $cartManager;
     */
    public function __construct(CartManagerInterface $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(Cart $cart, CartItem $item)
    {
        if (false === $cart->isEmpty()) {
            foreach ($cart->getCartItems() as $existingItem) {
                if ($existingItem->equals($item)) {
                    $existingItem->incrementQuantity($item->getQuantity());

                    return;
                }
            }
        }

        $cart->addCartItem($item);
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(Cart $cart, CartItem $item)
    {
        $cart->removeCartItem($item);
    }

    /**
     * {@inheritdoc}
     */
    public function refresh(Cart $cart)
    {
        $cart->setTotalItems($cart->countCartItems());
    }

    /**
     * {@inheritdoc}
     */
    public function clear(Cart $cart)
    {
        $this->cartManager->removeCart($cart);
    }

    /**
     * {@inheritdoc}
     */
    public function save(Cart $cart)
    {
        $this->cartManager->persistCart($cart);
    }
}
