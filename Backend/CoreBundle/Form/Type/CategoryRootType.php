<?php
namespace Chewbacca\Backend\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Chewbacca\Backend\CoreBundle\Form\Type\NatureType;

class CategoryRootType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
		$builder->add('title');
		#$builder->add('nature.id', 'hidden');
    }

    public function getName()
    {
        return 'category';
    }

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Chewbacca\CoreBundle\Entity\Category',
		);
	}
}