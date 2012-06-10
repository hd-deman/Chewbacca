<?php
namespace Chewbacca\OrdersBundle\Form\Type;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Chewbacca\UserBundle\Entity\UserPhone;
use Chewbacca\UserBundle\Entity\User;

class OrderUserPhoneTransformer implements DataTransformerInterface
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
	 * @param userPhonees
	 */
	public function __construct(ObjectManager $om, User $user)
	{
		$this->om = $om;
		$this->user = $user;
	}

	/**
	 * Transforms an object (userPhone) to a array().
	 *
	 * @param  userPhone|null $userPhone
	 * @return array
	 */
	public function transform($userPhone)
	{
		$res = null;
		if(is_object($userPhone)){
			if($userPhone->getId()){
				$res = array('new' => new UserPhone(), 'exist' => $userPhone->getId());
			}else{
				$res = array('new' => $userPhone, 'exist' => 'create_new');
			}
		}

		return $res;
	}

	/**
	 * Transforms a array (phone) to an object (userPhone).
	 *
	 * @param  array $phone
	 * @return userPhone|null
	 */
	public function reverseTransform($phone)
	{
		if(!array_key_exists("exist", $phone) or $phone["exist"] == "create_new"){
			return $phone["new"]->setUser($this->user);
		}

		$userPhone = $this->om
            ->getRepository('ChewbaccaUserBundle:UserPhone')
            ->findOneBy(array(
            	'id' => $phone["exist"],
            	'user' => $this->user->getId()
            ));

        if (null === $userPhone) {
            throw new TransformationFailedException(sprintf(
                'An userPhone with id "%s" does not exist!',
                $phone["exist"]
            ));
        }
  		return $userPhone;
	}
}

