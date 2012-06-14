<?php
namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Chewbacca\OrdersBundle\Entity\DeliveryAddress;
use Chewbacca\UserBundle\Entity\User;

class OrderDeliveryAddressTransformer implements DataTransformerInterface
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
     * @param deliveryAddresses
     */
    public function __construct(ObjectManager $om, User $user)
    {
        $this->om = $om;
        $this->user = $user;
    }

    /**
     * Transforms an object (deliveryAddress) to a array().
     *
     * @param  deliveryAddress|null $deliveryAddress
     * @return array
     */
    public function transform($deliveryAddress)
    {
        if (is_object($deliveryAddress)) {
            if ($deliveryAddress->getId()) {
                return array('new' => new DeliveryAddress(), 'exist' => $deliveryAddress->getId());
            } else {
                return array('new' => $deliveryAddress, 'exist' => 'create_new');
            }
        }

        return null;
    }

    /**
     * Transforms a array (address) to an object (deliveryAddress).
     *
     * @param  array                $address
     * @return deliveryAddress|null
     */
    public function reverseTransform($address)
    {
        if (!array_key_exists("exist", $address) or $address["exist"] == "create_new") {
            return $address["new"]->setUser($this->user);
        }

        $deliveryAddress = $this->om
            ->getRepository('ChewbaccaOrdersBundle:DeliveryAddress')
            ->findOneBy(array(
                'id' => $address["exist"],
                'user' => $this->user->getId()
            ));

        if (null === $deliveryAddress) {
            throw new TransformationFailedException(sprintf(
                'An DeliveryAddress with id "%s" does not exist!',
                $address["exist"]
            ));
        }

          return $deliveryAddress;
    }
}

