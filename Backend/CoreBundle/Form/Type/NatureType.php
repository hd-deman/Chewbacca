<?php
namespace Chewbacca\Backend\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NatureType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('id');
    }

    public function getName()
    {
        return 'nature';
    }

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Chewbacca\CoreBundle\Entity\Nature',
		);
	}
}