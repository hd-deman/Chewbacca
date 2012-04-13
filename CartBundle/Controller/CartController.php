<?php

namespace Chewbacca\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Chewbacca\CartBundle\Entity\CartManager;
use Chewbacca\CartBundle\Provider\CartProvider;
use Chewbacca\CartBundle\Storage\SessionCartStorage;

class CartController extends Controller
{

    /**
     * Displays cart.
     *
     * @return Response
     */
    public function showAction()
    {
    	$CartManager = new CartManager($this->getDoctrine()->getEntityManager(), 'Chewbacca\CartBundle\Entity\Cart');
    	$CartProvider = new CartProvider(new SessionCartStorage($this->get('session')), $CartManager);
        $cart = $CartProvider->getCart();
        #$form = $this->container->get('form.factory')->create('sylius_cart');
        #$form->setData($cart);

		return $this->render('ChewbaccaCartBundle:Cart:show.html.twig', array(
            #'cart' => $cart,
            #'form' => $form->createView()
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
        $cart = $this->container->get('sylius_cart.provider')->getCart();
        $item = $this->container->get('sylius_cart.resolver')->resolveItemToAdd($request);

        if (!$item) {
            throw new NotFoundHttpException('Requested item could not be added to cart');
        }

        $this->container->get('event_dispatcher')->dispatch(SyliusCartEvents::ITEM_ADD, new CartOperationEvent($cart, $item));

        $cartOperator = $this->container->get('sylius_cart.operator');
        $cartOperator->addItem($cart, $item);
        $cartOperator->refresh($cart);

        $errors = $this->container->get('validator')->validate($cart);
        if (0 === count($errors)) {
            $cartOperator->save($cart);
        }

        return new RedirectResponse($this->container->get('router')->generate('sylius_cart_show'));
    }

}
