<?php

namespace Chewbacca\Backend\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Chewbacca\CoreBundle\Entity\Category;
use Doctrine\ORM\Query\Expr;
class CategoryController extends Controller
{
	public function indexAction()
	{
		$em = $this->get('doctrine.orm.entity_manager');
		$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Category');
		$qb = $em->createQueryBuilder();

		$roots = $repo->getRootNodesQueryBuilder()
			->innerJoin('node.nature', 'n')
			->andWhere($qb->expr()->eq('n.title', ':title'))
			->setParameter('title', 'mltd')
			->getQuery()
			->getResult();

		$category = new Category();
		#$task->setTask('Write a blog post');
		#$task->setDueDate(new \DateTime('tomorrow'));
		
		$category_form = $this->createFormBuilder($category)
			->add('title', 'text')
			#->add('dueDate', 'date')
			->getForm();

		return $this->render('ChewbaccaBackendCoreBundle:Categories:roots.html.twig', array(
			'roots' => $roots,
			'form' => $category_form->createView())
		);
	}

	public function treeAction(Reqiest $request){
		$em = $this->get('doctrine.orm.entity_manager');
		$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Category');
		$qb = $em->createQueryBuilder();



/*
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
*/

		$category = new Category();
		#$task->setTask('Write a blog post');
		#$task->setDueDate(new \DateTime('tomorrow'));
		
		$category_form = $this->createFormBuilder($category)
			->add('title', 'text')
			#->add('dueDate', 'date')
			->getForm();


		$root = $repo->getRootNodes();
		$food = $repo->findOneByTitle('Food');
		#echo $repo->childCount($food);
		// prints: 3
		#echo $repo->childCount($food, true/*direct*/);
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
		var_dump($repo->getRootNodesQueryBuilder()
			->innerJoin('node.nature', 'n' #, 'ON', 'node.root = n.id and n.title=:title'
				/*$qb->expr()->andx(
					$qb->expr()->eq('node.root', 'n.id'),
					$qb->expr()->eq('n.title', ':title')
				)*/
			)->andWhere($qb->expr()->eq('n.title', ':title'))
			->setParameter('title', 'mltd')
			->getDQL());
			#die();
		$roots = $repo->getRootNodesQueryBuilder()
			->innerJoin('node.nature', 'n' #, 'ON', 'node.root = n.id and n.title=:title'
				/*$qb->expr()->andx(
					$qb->expr()->eq('node.root', 'n.id'),
					$qb->expr()->eq('n.title', ':title')
				)*/
			)->andWhere($qb->expr()->eq('n.title', ':title'))
			->setParameter('title', 'mltd')
			->getQuery()
			->getResult();

		$roots_path = array();
		foreach($roots as $root){
			echo 'x';
			#var_dump($root);
			$roots_path[] = $repo->children($root);
		}

		return $this->render('ChewbaccaBackendCoreBundle:Default:categories.html.twig', array(
			'tree' => $roots_path,
			'form' => $category_form->createView())
		);
	}

	public function newAction(Request $request)
	{
		// just setup a fresh $task object (remove the dummy data)
		$category = new Category();
		
		$form = $this->createFormBuilder($category)
			->add('title', 'text')
			->getForm();
		
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
		
			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				return $this->redirect($this->generateUrl('task_success'));
			}
		}
	}
}
