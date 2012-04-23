<?php

namespace Chewbacca\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
    	$cart = $this->container->get('chewbacca_cart.provider')->getCart(true);
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
        return new Response('');
        #return new RedirectResponse($this->container->get('router')->generate('sylius_cart_show'));
    }

    /**
     * Removes item from cart.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function removeItemAction(Request $request)
    {
        $cart = $this->container->get('chewbacca_cart.provider')->getCart();
        $item = $this->container->get('chewbacca_cart.resolver')->resolveItemToRemove($request);

        if (!$item || false === $cart->hasCartItem($item)) {
            throw new NotFoundHttpException('Requested item could not be removed from cart');
        }

        #$this->container->get('event_dispatcher')->dispatch(SyliusCartEvents::ITEM_REMOVE, new CartOperationEvent($cart, $item));

        $cartOperator = $this->container->get('chewbacca_cart.operator');
        $cartOperator->removeItem($cart, $item);
        $cartOperator->refresh($cart);
        $cartOperator->save($cart);

        return new RedirectResponse($this->container->get('router')->generate('chewbacca_cart'));
    }

    /**
     * Saves cart.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function saveAction(Request $request)
    {
        $cart = $this->container->get('chewbacca_cart.provider')->getCart();

        $form = $this->container->get('form.factory')->create('chewbacca_cart');
        $form->setData($cart);
        $form->bindRequest($request);

        if ($form->isValid()) {
            #$this->container->get('event_dispatcher')->dispatch(SyliusCartEvents::CART_SAVE, new FilterCartEvent($cart));

            $cartOperator = $this->container->get('chewbacca_cart.operator');
            $cartOperator->refresh($cart);
            $cartOperator->save($cart);
        }

        return $this->render('ChewbaccaCartBundle:Cart:show.html.twig', array(
            'cart' => $cart,
            'form' => $form->createView()
        ));
    }

    /**
     * Clears cart.
     *
     * @return Response
     */
    public function clearAction()
    {
        /*$cart = $this->container->get('sylius_cart.provider')->getCart();

        $this->container->get('event_dispatcher')->dispatch(SyliusCartEvents::CART_CLEAR, new FilterCartEvent($cart));
        $this->container->get('sylius_cart.operator')->clear($cart);

        return new RedirectResponse($this->container->get('router')->generate('sylius_cart_show'));*/
    }
}
