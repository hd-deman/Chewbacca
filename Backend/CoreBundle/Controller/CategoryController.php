<?php

namespace Chewbacca\Backend\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Chewbacca\CoreBundle\Entity\Category;
use Chewbacca\CoreBundle\Entity\Nature;
use Chewbacca\Backend\CoreBundle\Form\Type\CategoryType;
use Chewbacca\Backend\CoreBundle\Form\Type\CategoryRootType;

use Doctrine\ORM\Query\Expr;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
	public function indexAction($nature_title)
	{
		
		$em = $this->get('doctrine.orm.entity_manager');
		$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Category');
		$qb = $em->createQueryBuilder();

		$nature = $this->getDoctrine()
			->getRepository('ChewbaccaCoreBundle:Nature')
			->findOneBytitle($nature_title);
		if (!$nature) {
			throw $this->createNotFoundException('The nature does not exist');
		}

		$roots = $repo->getRootNodesQueryBuilder()
			->andWhere($qb->expr()->eq('node.nature', ':nature_id'))
			->setParameter('nature_id', $nature->getId())
			->getQuery()
			->getResult();

		$category = new Category();
		$category->setNature($nature);

		$category_form = $this->createForm(new CategoryRootType(), $category);

		return $this->render('ChewbaccaBackendCoreBundle:Categories:roots.html.twig', array(
			'roots' => $roots,
			'form' => $category_form->createView())
		);
	}

	public function newRootAction(Request $request)
	{
		$em = $this->get('doctrine.orm.entity_manager');

		$data = $request->request->get('category');
		$nature = $this->getDoctrine()
			->getRepository('ChewbaccaCoreBundle:Nature')
			->findOneById($data['nature.id']);
		if (!$nature) {
			throw $this->createNotFoundException('The nature does not exist');
		}
		$category = new Category();
		$category->setNature($em->getReference("ChewbaccaCoreBundle:Nature", $data['nature.id'] ));
		
		$form = $this->createForm(new CategoryRootType(), $category);
		
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				#$category = $form->getData();
				#$em->persist($category->getNature());
				$em->persist($category);
				$em->flush();
				return $this->redirect($this->generateUrl('categories_roots', array('nature_title' => $nature)));
			}
		}
		return $this->render('ChewbaccaBackendCoreBundle:Categories:roots.html.twig', array(
			'roots' => array(),
			'form' => $form->createView())
		);
	}

	public function treeAction($root_slug, Request $request){
		$em = $this->get('doctrine.orm.entity_manager');
		$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Category');
		$qb = $em->createQueryBuilder();

		$verify = $repo->verify();
		if($verify!==true){
			var_dump($verify);
			$repo->recover();
			$em->clear();
			$em->flush();
		}

		$root = $repo->findOneBySlug($root_slug);
		if (!$root) {
			throw $this->createNotFoundException('The root does not exist');
		}

		$category = new Category();
		$category->setNature($em->getReference("ChewbaccaCoreBundle:Nature", $root->getNature()->getId() ));
		if ($request->getMethod() == 'POST') {
			$data = $request->request->get('category');
			$category->setParent($em->getReference("ChewbaccaCoreBundle:Category", $data['parent.id'] ));
		}else{
			$category->setParent($root);
		}
		/*$category_form = $this->createFormBuilder($category)
			->add('title', 'text')
			->getForm();*/
		$tree = $repo->children($root);
		$tree_choices[$root->getId()] = 'корнвой раздел';
		foreach ($tree as $k => $value) {
			$tree_choices[$value->getId()] = str_repeat('- ', $value->getLvl()-1).$value->getTitle();
		}
		$form = $this->createForm(new CategoryType($tree_choices),$category);

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				#$category = $form->getData();
				#$em->persist($category->getNature());
				$em->persist($root);
				$em->persist($category);
				$em->flush();
				return $this->redirect($this->generateUrl('categories', array('root_slug' => $root->getSlug())));
			}
		}

		return $this->render('ChewbaccaBackendCoreBundle:Categories:categories.html.twig', array(
			'root' => $root,
			'tree' => $repo->children($root),
			'form' => $form->createView())
		);
	}

	public function treeSaveAction($root_slug, Request $request){
		$em = $this->get('doctrine.orm.entity_manager');
		$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Category');
		$root = $repo->findOneBySlug($root_slug);
		if (!$root) {
			throw $this->createNotFoundException('The root does not exist');
		}
		$tree = $request->request->get('list');
		$nodes = array();
		var_dump($tree);
		foreach ($tree as $id => $parent_id) {
			echo 's';
			echo $id.":".$parent_id."\n";
			if(!key_exists($id, $nodes)){
				$nodes[$id] = $repo->findOneById($id);
			}
			if($parent_id == 'root'){
				$nodes[$id]->setParent($root);
			}else{
				if(!key_exists($parent_id, $nodes)){
					$nodes[$parent_id] = $repo->findOneById($parent_id);
				}
				$nodes[$id]->setParent($nodes[$parent_id]);
			}
			
			$repo->moveDown($nodes[$id], true);
			$em->persist($nodes[$id]);
		}
		/*foreach ($nodes as $node) {
			$em->persist($node);
		}*/
		$em->persist($root);
		$em->flush();
	}

	public function nodeDeleteAction($node_id){
		$em = $this->get('doctrine.orm.entity_manager');
		$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Category');
		$node = $repo->findOneById($node_id);
		if (!$node) {
			throw $this->createNotFoundException('The node does not exist');
		}
		$repo->removeFromTree($node);
	}
}

