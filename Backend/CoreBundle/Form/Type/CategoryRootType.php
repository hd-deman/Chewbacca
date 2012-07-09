<?php
namespace Chewbacca\Backend\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryRootType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('nature', 'entity', array(
            'class' => 'ChewbaccaCoreBundle:Nature',
        ));
    }

    public function getName()
    {
        return 'category';
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Chewbacca\CoreBundle\Entity\Category',
        );
    }
}
