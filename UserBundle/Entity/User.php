<?php
namespace Chewbacca\UserBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="chewb_user")
*/
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\generatedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\OneToMany(targetEntity="\Chewbacca\OrdersBundle\Entity\Order", mappedBy="user")
	 */
	protected $orders;

	/**
	 * @ORM\OneToMany(targetEntity="\Chewbacca\OrdersBundle\Entity\DeliveryAddress", mappedBy="user")
	 */
	protected $delivery_addresses;

	/**
	 * @ORM\OneToMany(targetEntity="\Chewbacca\UserBundle\Entity\UserPhone", mappedBy="user")
	 */
	protected $phone_numbers;

	public function __construct()
	{
		parent::__construct();
		// your own logic
	}
	
	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Add orders
     *
     * @param Chewbacca\OrdersBundle\Entity\Order $orders
     */
    public function addOrder(\Chewbacca\OrdersBundle\Entity\Order $orders)
    {
        $this->orders[] = $orders;
    }

    /**
     * Get orders
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add delivery_addresses
     *
     * @param Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddresses
     * @return User
     */
    public function addDeliveryAddress(\Chewbacca\OrdersBundle\Entity\DeliveryAddress $deliveryAddresses)
    {
        $this->delivery_addresses[] = $deliveryAddresses;
        return $this;
    }

    /**
     * Get delivery_addresses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDeliveryAddresses()
    {
        return $this->delivery_addresses;
    }

    /**
     * Add phone_numbers
     *
     * @param Chewbacca\UserBundle\Entity\UserPhone $phoneNumbers
     * @return User
     */
    public function addUserPhone(\Chewbacca\UserBundle\Entity\UserPhone $phoneNumbers)
    {
        $this->phone_numbers[] = $phoneNumbers;
        return $this;
    }

    /**
     * Get phone_numbers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPhoneNumbers()
    {
        return $this->phone_numbers;
    }
}