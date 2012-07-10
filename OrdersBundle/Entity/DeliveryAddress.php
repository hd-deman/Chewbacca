<?php
namespace Chewbacca\OrdersBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  @ORM\Entity
 *  @ORM\HasLifecycleCallbacks()
 *  @ORM\Table(name="chewb_delivery_address")
 *
 **/
class DeliveryAddress
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
     * @ORM\ManyToOne(targetEntity="\Chewbacca\UserBundle\Entity\User", inversedBy="delivery_addresses", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * Firstname.
     *
     * @var string $firstname
     *
     * @Assert\NotBlank(groups={"check_new"})
     * @ORM\Column(name="firstname", type="string", length=120)
     */
    protected $firstname;

    /**
     * Lastname.
     *
     * @var string $lastname
     * @Assert\NotBlank(groups={"check_new"})
     * @ORM\Column(name="lastname", type="string", length=120)
     */
    protected $lastname;

    /**
     * @Assert\NotBlank(groups={"check_new"})
     * @ORM\ManyToOne(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country", inversedBy="delivery_addresses", cascade={"persist"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $country;

    /**
     * City.
     *
     * @var string $city
     * @Assert\NotBlank(groups={"check_new"})
     * @ORM\Column(name="city", type="string", length=120)
     */
    protected $city;

    /**
     * Postcode.
     *
     * @var string $postcode
     * @Assert\NotBlank(groups={"check_new"})
     * @ORM\Column(name="postcode", type="string", length=9)
     */
    protected $postcode;

    /**
     * Street.
     *
     * @var string $street
     * @Assert\NotBlank(groups={"check_new"})
     * @ORM\Column(name="street", type="string", length=255)
     */
    protected $street;

    /**
     * @var datetime $created
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\OrdersBundle\Entity\Order", mappedBy="delivery_address", cascade={"all"})
     */
    protected $orders;

    /**
     * Get full address
     *
     * @return datetime
     */
    public function getFullAddress()
    {
        return sprintf('%s, %s, %s, %s, %s', $this->getFirstname(),
                $this->getLastname(), $this->getCity(), $this->getPostcode(),
                $this->getStreet());
    }
    /**
     * Get created
     *
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param  string          $firstname
     * @return DeliveryAddress
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param  string          $lastname
     * @return DeliveryAddress
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set created
     *
     * @return DeliveryAddress
     * @ORM\prePersist
     */

    public function setCreatedValue()
    {
        $this->created = new \DateTime();

        return $this;
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
     * Set street
     *
     * @param  string          $street
     * @return DeliveryAddress
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param  string          $city
     * @return DeliveryAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postcode
     *
     * @param  string          $postcode
     * @return DeliveryAddress
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set created
     *
     * @param  datetime        $created
     * @return DeliveryAddress
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Set country
     *
     * @param  Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country $country
     * @return DeliveryAddress
     */
    public function setCountry(
            \Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Chewbacca\StoreBundle\StoreCoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set user
     *
     * @param  Chewbacca\UserBundle\Entity\User $user
     * @return DeliveryAddress
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

    /**
     * Remove orders
     *
     * @param Chewbacca\OrdersBundle\Entity\Order $orders
     */
    public function removeOrder(\Chewbacca\OrdersBundle\Entity\Order $orders)
    {
        $this->orders->removeElement($orders);
    }
}
