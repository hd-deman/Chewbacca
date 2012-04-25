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
}