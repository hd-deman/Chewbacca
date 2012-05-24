<?php

namespace Chewbacca\OrdersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrderController extends Controller
{
	/**
	 * @Template()
	 */
	public function proccessAction()
	{
		$cart = $this->container->get('chewbacca_cart.provider')->getCart();
		if(!($cart->getTotalItems() && $cart->getValue())){
			return new RedirectResponse($this->container->get('router')->generate('chewbacca_cart'));
		}
		$user = $this->container->get('security.context')->getToken()->getUser();
		$order = $this->container->get('chewbacca_orders.manager.order')->createOrder($cart);
		$order->setUser($user);

		$form = $this->container->get('form.factory')->create('chewbacca_order');
        $form->setData($order);

		return $this->render('ChewbaccaOrdersBundle:Frontend:proccess.html.twig', array(
            'order' => $order,
            'form' => $form->createView()
        ));
	}

    /**
     * Saves order.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function saveAction(Request $request)
    {
		$cart = $this->container->get('chewbacca_cart.provider')->getCart();
		$user = $this->container->get('security.context')->getToken()->getUser();
		$order = $this->container->get('chewbacca_orders.manager.order')->createOrder($cart);
		$order->setUser($user);

        $form = $this->container->get('form.factory')->create('chewbacca_order', $order);
        #$form->setData($order);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $this->container->get('chewbacca_orders.manager.order')->persistOrder($order);
            return new RedirectResponse($this->container->get('router')->generate('chewbacca_payment_proccess', array('order_id' => $order->getId())));
        }

		return $this->render('ChewbaccaOrdersBundle:Frontend:proccess.html.twig', array(
            'order' => $order,
            'form' => $form->createView()
        ));
    }
}