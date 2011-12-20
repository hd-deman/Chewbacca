<?php

namespace Chewbacca\Backend\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Chewbacca\CoreBundle\Entity\Category;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeLacrocoStoreBundle:Default:index.html.twig');
    }

	public function sectionsAction()
    {
    	$em = $this->get('doctrine.orm.entity_manager');
		$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Category');




$food = new Category();
$food->setTitle('Food');
 
$fruits = new Category();
$fruits->setTitle('Fruits');
$fruits->setParent($food);
 
$apple = new Category();
$apple->setTitle('Apple');
$apple->setParent($fruits);
 
$vegetables = new Category();
$vegetables->setTitle('Vegetables');
$vegetables->setParent($food);
 
$carrots = new Category();
$carrots->setTitle('Carrots');
$carrots->setParent($vegetables);
     

$em->persist($food);
$em->persist($fruits);
$em->persist($apple);
$em->persist($vegetables);
$em->persist($carrots);
$em->flush();





		$root = $repo->getRootNodes();
		$food = $repo->findOneByTitle('Food');
		echo $repo->childCount($food);
		// prints: 3
		echo $repo->childCount($food, true/*direct*/);
		// prints: 2
		$children = $repo->children($root[0]);
		/*foreach($children as $child){
			echo $child->getTitle();
		}*/
		// $children contains:
		// 3 nodes
		#$categories = $this->get('doctrine.orm');
		$carrots = $repo->findOneByTitle('Carrots');
		#$path = $repo->getLeafs($root);
		#var_dump($path);
		/*foreach($path as $i){
			echo $i->getTitle();
			#var_dump($i);
			#die();
		}*/
		#die();
    #->execute(array()/*, $em::HYDRATE_ARRAY_HIERARCHY*/);
	
		$children = $repo->children($food, false, 'title');
		#var_dump($categories);
		// will sort the children by title
		$carrots = $repo->findOneByTitle('Carrots');
		$path = $repo->getPath($carrots);
		return $this->render('ChewbaccaBackendCoreBundle:Default:sections.html.twig',
			array('tree' => $path)
		);
    }
}

