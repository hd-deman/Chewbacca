<?php

namespace Chewbacca\ExchangeRatesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ChewbaccaExchangeRatesBundle:Default:index.html.twig', array('name' => $name));
    }
}
