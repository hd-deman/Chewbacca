<?php

namespace Chewbacca\CartBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface ;

/**
 * Cart item type.
 *
 */
class ItemType extends AbstractType
{
    /**
     * Data class.
     *
     * @var string
     */
    protected $dataClass;

    /**
     * Constructor.
     *
     * @param string $dataClass
     */
    public function __construct($dataClass)
    {
        $this->dataClass = $dataClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface  $builder, array $options)
    {
        $builder->add('quantity', 'hidden');
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => $this->dataClass
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'chewbacca_cart_item';
    }
}
