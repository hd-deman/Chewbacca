<?php
namespace Chewbacca\Backend\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Chewbacca\Backend\CoreBundle\Form\Type\NatureType;

class CategoryType extends AbstractType
{

	public function __construct($parents_root){
		$this->parents_root = $parents_root;
	}

    public function buildForm(FormBuilder $builder, array $options)
    {
		$parents_root = $this->parents_root;
		$builder->add('title');
		$builder->add('parent',
		              'entity',
		               array(
		                     'class'=>'ChewbaccaCoreBundle:Category',
		                     'property'=>'title_with_indent',
		                     'query_builder' => function ($repository) use ($parents_root)
		                     {
		                     	 var_dump(get_class($repository),get_class($repository));
		                         return $repository->childrenQueryBuilder($parents_root)
		                                #->where('s.status_type = ?1')
		                               # ->setParameter(1, 'basic')
		                               # ->add('orderBy', 's.sort_order ASC')
		                               ;
		                     },
		                     'empty_value' => 'Choose an option',
		                     'required' => false
		                    )
		              );
					  #var_dump($builder->getData());
		#$builder->add('parent', new CategoryParentType());
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

class CategoryParentType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('title');
	}
	
    public function getName()
    {
        return 'category_parent';
    }

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Chewbacca\CoreBundle\Entity\Category',
		);
	}
}
