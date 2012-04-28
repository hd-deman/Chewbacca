<?php

namespace Chewbacca\OrdersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class OrderController extends Controller
{
	/**
	 * @Template()
	 */
	public function proccessAction()
	{
		$cart = $this->container->get('chewbacca_cart.provider')->getCart();
		if(!($cart->getTotalItems() && $cart->getValue())){
			#return false; //@TODO throw exception
		}
		$order = $this->container->get('chewbacca_orders.manager.order')->createOrder($cart);

		return $this->render('ChewbaccaOrdersBundle:Frontend:proccess.html.twig', array(
            'order' => $order,
            #'form' => $form->createView()
        ));
	}
}