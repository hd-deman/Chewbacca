<?php

namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface ;
use Chewbacca\UserBundle\Form\Type\UserPhoneFormType;
/**
 * Order form form.
 *
 */
class OrderFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface  $builder, array $options)
    {
		$builder->add('deliveryAddress', 'order_delivery_address', array('error_bubbling' => false));
        //$builder->add('deliveryAddress', new DeliveryAddressFormType(), array('label' => 'Адресс доставки'));
        //$builder->add('phone', new UserPhoneFormType(), array('error_bubbling' => false));
    }

    public function getDefaultOptions()
    {
        return array(
        	'csrf_protection' => false,
        	'cascade_validation' => true,
            'data_class' => 'Chewbacca\OrdersBundle\Entity\Order',
        );
    }

    public function getName()
    {
        return 'order';
    }

}