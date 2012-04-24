<?php

namespace Chewbacca\CartBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Cart form form.
 *
 */
class CartFormType extends AbstractType
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
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('cart_items', 'collection', array(
            'type' => 'chewbacca_cart_item',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
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
        return 'chewbacca_cart';
    }
}
