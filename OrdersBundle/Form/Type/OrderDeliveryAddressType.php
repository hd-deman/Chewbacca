<?php

namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface ;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * DeliveryAddress form form.
 *
 */
class OrderDeliveryAddressType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var User
     */
    private $user;

    /**
     * @param security_context
     */
    public function __construct(ObjectManager $om, SecurityContextInterface $security_context)
    {
        $this->om = $om;
        $this->user = $security_context->getToken()->getUser();
    }

   public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $delivery_addresses = array();
        foreach($this->user->getDeliveryAddresses() as $add){
            $delivery_addresses[$add->getId()] = $add->getFullAddress();
        }

        if(!empty($delivery_addresses)){
            $delivery_addresses['create_new'] = 'Создать новый';
            $builder->add('exist', 'choice', array(
                'choices'   => $delivery_addresses,
                'required'  => false,
                'expanded'  => true
            ));
        }

        $builder->add('new', 'delivery_address', array('error_bubbling' => false, 'required' => false));

        $transformer = new OrderDeliveryAddressTransformer($this->om, $this->user);
        $builder->appendClientTransformer($transformer);
    }

    public function getDefaultOptions()
    {
        return array(
            #'cascade_validation' => true
        );
    }

    public function getName()
    {
        return 'order_delivery_address';
    }
}