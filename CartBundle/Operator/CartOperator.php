<?php

namespace Chewbacca\CartBundle\Operator;

use Chewbacca\CartBundle\Entity\Cart;
use Chewbacca\CartBundle\Operator\BaseCartOperator;

/**
 * Cart operator.
 *
 */
class CartOperator extends BaseCartOperator
{
    public function refresh(Cart $cart)
    {
        $value = 0.00;

        foreach ($cart->getCartItems() as $item) {
            $value += $item->getProductSet()->getProduct()->getStorePrice() * $item->getQuantity();
        }

        $cart->setValue($value);

        parent::refresh($cart);
    }
}
