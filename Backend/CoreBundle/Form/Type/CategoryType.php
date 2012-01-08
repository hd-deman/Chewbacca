<?php
namespace Chewbacca\Backend\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Chewbacca\Backend\CoreBundle\Form\Type\NatureType;

class CategoryType extends AbstractType
{
	private $tree_choices = array();

	public function __construct($tree){
		$this->tree_choices = $tree;
	}

    public function buildForm(FormBuilder $builder, array $options)
    {
		$builder->add('title');
		$builder->add('nature.id', 'hidden');
		$builder->add('parent.id', 'choice', array(
			'choices' => $this->tree_choices,
				'empty_value' => false)
			);
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