<?php

namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Order form form.
 *
 */
class OrderFormType extends AbstractType
{
   public function buildForm(FormBuilder $builder, array $options)
    {

		$builder->add('deliveryAddress','entity', 
			array('class' => 'Chewbacca\OrdersBundle\Entity\DeliveryAddress',
				'property' => 'Firstname',
				'query_builder' => function ($repository) {
					return $repository->createQueryBuilder('add')->orderBy('add.created', 'DESC');
				},
				'label' => 'Адресс доставки',
				'expanded' => true
				)
			);
		$builder->add('deliveryAddress', new DeliveryAddressFormType(), array('label' => 'Адресс доставки'));
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Chewbacca\OrdersBundle\Entity\Order',
        );
    }

    public function getName()
    {
        return 'order';
    }

}