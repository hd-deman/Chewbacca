<?php

namespace Chewbacca\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{

    /**
     * Displays cart.
     *
     * @return Response
     */
    public function showAction()
    {
    	$cart = $this->container->get('chewbacca_cart.provider')->getCart();
        $form = $this->container->get('form.factory')->create('chewbacca_cart');
        $form->setData($cart);

		return $this->render('ChewbaccaCartBundle:Cart:show.html.twig', array(
            'cart' => $cart,
            'form' => $form->createView()
        ));
    }

    /**
     * Adds item to cart.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addItemAction(Request $request)
    {
        $cart = $this->container->get('chewbacca_cart.provider')->getCart();
        $item = $this->container->get('chewbacca_cart.resolver')->resolveItemToAdd($request);

        if (!$item) {
            throw new NotFoundHttpException('Requested item could not be added to cart');
        }


        $cartOperator = $this->container->get('chewbacca_cart.operator');
        $cartOperator->addItem($cart, $item);
        $cartOperator->refresh($cart);

        $errors = $this->container->get('validator')->validate($cart);
        if (0 === count($errors)) {
            $cartOperator->save($cart);
        }

        #return new RedirectResponse($this->container->get('router')->generate('sylius_cart_show'));
    }

}
