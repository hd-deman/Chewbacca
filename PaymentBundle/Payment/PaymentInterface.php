<?php

namespace Chewbacca\PaymentBundle\Payment;

/**
 * Interface for payment object.
 *
 */
interface PaymentInterface
{
    /**
     * Create bill.
     *
     * @return 
     */
    function createBill($params);

    /**
     * Create bill.
     *
     * @return 
     */
    function cancelBill($params);
}