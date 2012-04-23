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
        return array('name' => '');
    }
}
