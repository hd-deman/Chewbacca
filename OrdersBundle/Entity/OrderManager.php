<?php
namespace Chewbacca\OrdersBundle\Entity;

use Doctrine\ORM\EntityManager;

use Chewbacca\OrdersBundle\Entity\Order;
use Chewbacca\CartBundle\Entity\Cart;

use Chewbacca\OrdersBundle\Model\OrderManager as BaseOrderManager;

/**
 * Order manager for Doctrine ORM driver.
 *
 */

class OrderManager extends BaseOrderManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Entity repository.
     *
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Item Manager
     *
     * @var ItemManager
     */
    protected $itemManager;

    /**
     * Constructor.
     *
     * @param EntityManager $entityManager
     * @param string        $class
     */
    public function __construct(EntityManager $entityManager, $class)
    {
        parent::__construct($class);

        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($this->getClass());
    }

	public function setItemManager(ItemManager $itemManager){
		$this->itemManager = $itemManager;
	}

    /**
     * {@inheritdoc}
     */
    public function createOrder(Cart $cart)
    {
        $class = $this->getClass();
        return new $class;
    	foreach($cart->getCartItems() as $cart_item){
    		$order_item = $itemManager->createItem($cart_item);
    	}
    }

    /**
     * {@inheritdoc}
     */
    public function persistOrder(Order $order)
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeOrder(Order $order)
    {
        $this->entityManager->remove($order);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findOrder($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrderBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrders()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findOrdersBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}