<?php

namespace Chewbacca\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChewbaccaHelloBundle:Default:index.html.twig');
    }
}
