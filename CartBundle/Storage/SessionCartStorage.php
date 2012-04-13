<?php

namespace Chewbacca\CartBundle\Storage;

use Chewbacca\CartBundle\Entity\Cart;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Stores current cart id inside the user session.
 *
 */
class SessionCartStorage implements CartStorageInterface
{
    /**
     * Session.
     *
     * @var SessionInterface
     */
    protected $session;

    /**
     * Constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentCartIdentifier()
    {
        return $this->session->get('_chewb.cart-id');
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrentCartIdentifier(Cart $cart)
    {
        $this->session->set('_chewb.cart-id', $cart->getId());
    }
}
