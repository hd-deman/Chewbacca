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
    public function createBill($params);

    /**
     * Create bill.
     *
     * @return
     */
    public function cancelBill($params);
}
