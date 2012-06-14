<?php

namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface ;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Order form form.
 *
 */
class OrderFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface  $builder, array $options)
    {

        $builder->add('deliveryAddress', 'order_delivery_address', array('validation_groups' => array('check_new')));
        $builder->add('phone', 'order_user_phone', array('validation_groups' => array('check_new')));
        //$builder->add('phone', new UserPhoneFormType(), array('error_bubbling' => false));

        $builder->addEventListener(FormEvents::PRE_BIND, function(DataEvent $event) use ($builder){
            $data = $event->getData();
            if ($data) {
                if (key_exists('exist', $data['deliveryAddress']) && $data['deliveryAddress']['exist'] != 'create_new') {
                    $event->getForm()->remove('deliveryAddress');
                    $event->getForm()->add($builder->create('deliveryAddress', 'order_delivery_address', array('validation_groups' => array('check_exist')))->getForm());
                }
                if (key_exists('exist', $data['phone']) && $data['phone']['exist'] != 'create_new') {
                    $event->getForm()->remove('phone');
                    $event->getForm()->add($builder->create('phone', 'order_user_phone', array('validation_groups' => array('check_exist')))->getForm());
                }
            }
        });
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
