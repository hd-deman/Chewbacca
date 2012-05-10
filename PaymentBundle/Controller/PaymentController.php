<?php

namespace Chewbacca\PaymentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Chewbacca\PaymentBundle\QiwiPayment\createBill;

class PaymentController extends Controller
{
    /**
     * @Route("/hello/{name}")
     *  
     */
    public function proccessAction($order_id)
    {
        return $this->proccessQiwiAction($order_id);
    }

    public function proccessQiwiAction($order_id){
        $order = $this->container->get('chewbacca_orders.manager.order')->findOrder($order_id);
        if (!$order) {
            throw new NotFoundHttpException('Order entity not found');
        }
        /*$qiwi_payment = $this->container->get('chewbacca_payment.qiwi_payment');
        $code = $qiwi_payment->createBill($order);*/
        $code = 0;
        if($code===0){
            return $this->render('ChewbaccaPaymentBundle:PaymenQiwi:success.html.twig', array(
                'order' => $order
            ));
        }else{
            error_log(sprintf('qiwi payment failed: order nubmer is %s code is %s', $order->getId(), $code));
            return $this->render('ChewbaccaPaymentBundle:Payment:fail.html.twig', array(
                'order' => $order
            ));
        }
    }
}
