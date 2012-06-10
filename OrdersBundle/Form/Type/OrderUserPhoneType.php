<?php

namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface ;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\SecurityContextInterface;


use Chewbacca\OrdersBundle\Entity\DeliveryAddress;

/**
 * DeliveryAddress form form.
 *
 */
class OrderUserPhoneType extends AbstractType
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
        $phones = array();
        foreach($this->user->getPhoneNumbers() as $phone){
            $phones[$phone->getId()] = $phone->getPhoneNumber();
        }

        if(!empty($phones)){
        	$phones['create_new'] = 'Создать новый';
        	$builder->add('exist', 'choice', array(
        			'choices'   => $phones,
        			'required'  => false,
        			'expanded'  => true,
        	));
        }

        $builder->add('new', 'user_phone', array('required' => false));

        $transformer = new OrderUserPhoneTransformer($this->om, $this->user);
        $builder->appendClientTransformer($transformer);
    }

    public function getDefaultOptions()
    {
        return array(
            'error_mapping' => array(
                'phone_number' => 'new.phone_number',
            )
        );
    }

    public function getName()
    {
        return 'create_new_or_select_exists';
    }
}