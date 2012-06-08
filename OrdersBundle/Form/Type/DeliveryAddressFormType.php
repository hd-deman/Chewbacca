<?php

namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * DeliveryAddress form form.
 *
 */
class DeliveryAddressFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', null, array('error_bubbling'=>false));
        $builder->add('lastname', null, array('error_bubbling'=>false));
        $builder->add('country','entity',
            array('class' => 'Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country',
                'property' => 'Title',
                'query_builder' => function ($repository) {
                    return $repository->createQueryBuilder('c')->orderBy('c.title', 'ASC');
                },
                'error_bubbling' => false
                )
            );
        $builder->add('city', null, array('error_bubbling'=>false));
        $builder->add('postcode', null, array('error_bubbling'=>false));
        $builder->add('street', null, array('error_bubbling'=>false));
    }

    public function getDefaultOptions()
    {
        return array(
            'is_virtual' => false,
            'data_class' => 'Chewbacca\OrdersBundle\Entity\DeliveryAddress',
        );
    }

    public function getName()
    {
        return 'delivery_address';
    }

}