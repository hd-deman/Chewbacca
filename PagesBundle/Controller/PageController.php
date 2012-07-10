<?php

namespace Chewbacca\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($slug, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $pages_repo = $em->getRepository('ChewbaccaPagesBundle:Page');
        $page = $pages_repo->find($id);
        if (!$page) {
            throw $this->createNotFoundException('The page does not exist');
        } elseif ($page->getSlug()!=$slug) {
            return new RedirectResponse($this->container->get('router')->generate('ChewbaccaPagesBundle_page_view', array('slug' => $page->getSlug(), 'id' => $page->getId())), 301);
        }

        $breadcrumbs = array(
            array(
                'title' => $page->getTitle(),
                'url' => $this->generateUrl('ChewbaccaPagesBundle_page_view', array('slug' => $page->getSlug(), 'id' => $page->getId()))
            )
        );

        return $this->render('ChewbaccaPagesBundle:Page:index.html.twig', array(
            'page' => $page,
            'breadcrumbs' => $breadcrumbs
        ));
    }
}
