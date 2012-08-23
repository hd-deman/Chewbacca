<?php
namespace Chewbacca\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * UserPhone form form.
 *
 */
class UserPhoneFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phone_number', null, array('max_length' => 20));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Chewbacca\UserBundle\Entity\UserPhone',
        );
    }

    public function getName()
    {
        return 'user_phone';
    }
}
