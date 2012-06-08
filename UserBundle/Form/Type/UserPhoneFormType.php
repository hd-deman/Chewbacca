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
        $builder->add('phone_number');
    }

    public function getDefaultOptions()
    {
        return array(
        );
    }

    public function getName()
    {
        return 'user_phone';
    }
}