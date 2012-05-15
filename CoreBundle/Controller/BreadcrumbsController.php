<?php
namespace Chewbacca\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
Doctrine\ORM\Query,
Chewbacca\CoreBundle\Entity\Category;

class BreadcrumbsController extends Controller
{
	public function pathAction($breadcrumbs = array())
	{
		$breadcrumbs = array_merge(array(array('title' => 'главная', 'url' => $this->generateUrl('homepage'))), $breadcrumbs);

		return $this->render('ChewbaccaCoreBundle:Breadcrumbs:path.html.twig', array('breadcrumbs' => $breadcrumbs));
	}
}