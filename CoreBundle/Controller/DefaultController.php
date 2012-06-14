<?php

namespace Chewbacca\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Doctrine\ORM\Query,
    Chewbacca\CoreBundle\Entity\Category;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('ChewbaccaBackendCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
