<?php
namespace Chewbacca\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *  @ORM\Table(name="chewb_orders_phones")
 *
 **/
 class UserPhone
 {
    /**
     * @var integer $id
     *
     * @Assert\NotBlank(groups={"check_exist"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\UserBundle\Entity\User", inversedBy="phone_numbers", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * Phone Number
     *
     * @var string $phone_number
     *
     * @Assert\NotBlank(groups={"check_new"})
     * @Assert\Regex(
     *     pattern="~\+?[\d\s()-]+~",
     *     groups={"check_new"},
     *     message="Не верный формат номера телефона"
     * )
     * @ORM\Column(name="phone_number", type="string", length=12)
     */
    protected $phone_number;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\OrdersBundle\Entity\Order", mappedBy="phone", cascade={"all"})
     */
    protected $orders;

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
     * Set phone_number
     *
     * @param  string    $phoneNumber
     * @return UserPhone
     */
    public function setPhoneNumber($phoneNumber)
    {
        //@TODO move this to purify phone helper
        $phoneNumber = preg_replace('~^8~', '7', $phoneNumber);
        $this->phone_number = preg_replace('~[^\d]+~', '', $phoneNumber);

        return $this;
    }

    /**
     * Get phone_number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set user
     *
     * @param  Chewbacca\UserBundle\Entity\User $user
     * @return UserPhone
     */
    public function setUser(\Chewbacca\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return Chewbacca\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
