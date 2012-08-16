<?php
namespace Chewbacca\ProductPromoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

use Doctrine\ORM\EntityRepository;

class ProductPromoAdmin extends Admin
{
    private $service_container;
    public function setServiceContainer($serviceContainer)
    {
        $this->service_container = $serviceContainer;
    }
    protected function configureFormFields(FormMapper $formMapper)
    {
        $data = $this->service_container->get('request')->get($this->uniqid);
        $ids = array(0);

        if ($data['products']) {
            foreach ($data['products'] as $id) {
                $ids[] = $id;
            }
        } elseif ($obj_id = $this->service_container->get('request')->get('id')) {
            foreach ($this->getObject($obj_id)->getProducts() as $p) {
                $ids[] = $p->getId();
            }
        }
        $formMapper
            ->with('General')
                ->add('title')
                ->add('description')
            ->end()
            ->with('Products')
                ->add('brand', 'entity', array(
                'class' => 'ChewbaccaStoreCoreBundle:Brand',
                'property_path' => false,
                'empty_value' => 'Choose a Brand',
                'required' => false,
                ))
                ->add('products', null, array(//'choices' => array(),
                    'multiple' => true,
                    'expanded' => true,                /*'property_path' => false*/
                    'query_builder' => function(EntityRepository $er) use ($ids) {
                        return $er->createQueryBuilder('p')
                            ->where('p.id in ('.implode(',', $ids).')');
                    },
                 ))
             ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('description')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('description')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('title')
                ->assertMaxLength(array('limit' => 72))
            ->end()
        ;
    }

    public function preUpdate($productPromo)
    {

    }

    public function getEditTemplate()
    {
        return 'ChewbaccaProductPromoBundle:ProductPromo:base_edit.html.twig';
    }
}
