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
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('country','entity',
            array('class' => 'Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country',
                'property' => 'Title',
                'query_builder' => function ($repository) {
                    return $repository->createQueryBuilder('c')->orderBy('c.title', 'ASC');
                }
            )
        );
        $builder->add('city');
        $builder->add('postcode');
        $builder->add('street');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Chewbacca\OrdersBundle\Entity\DeliveryAddress',
        );
    }

    public function getName()
    {
        return 'delivery_address';
    }

}
