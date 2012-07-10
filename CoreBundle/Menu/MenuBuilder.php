<?php
namespace Chewbacca\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
class MenuBuilder
{
    private $factory;
    private $entityManager;
    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, EntityManager $entityManager)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
    }

    public function createMainMenu(Request $request)
    {
        $repo = $this->entityManager->getRepository('Chewbacca\CoreBundle\Entity\Category');
        $root = $repo->findOneBySlug('main');
        $qb = $repo->childrenQueryBuilder($root)
            ->innerJoin('node.page', 'p');

        $categories = $qb->getQuery()->useResultCache(true)->setResultCacheLifetime(10800)->getResult();

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        foreach ($categories as $node) {
            $menu->addChild($node->getTitle(), array('route' => 'ChewbaccaPagesBundle_page_view',
                'routeParameters' => array('id' => $node->getPage()->getId(),
                    'slug' => $node->getPage()->getSlug()
                )
            ));
        }
        /*$menu->addChild('Home', array('route' => 'homepage'));
        $menu->addChild('About Me', array(
            'route' => 'page_show',
            'routeParameters' => array('id' => 42)
        ));*/
        // ... add more children

        return $menu;
    }
}
