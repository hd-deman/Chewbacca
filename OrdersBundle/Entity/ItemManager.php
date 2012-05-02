<?php

namespace Chewbacca\OrdersBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Chewbacca\CartBundle\Entity\CartItem;

use Chewbacca\OrdersBundle\Model\ItemInterface;
use Chewbacca\OrdersBundle\Model\ItemManager as BaseItemManager;

/**
 * Doctrine ORM driver item manager.
 *
 */
class ItemManager extends BaseItemManager
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

    /**
     * {@inheritdoc}
     */
    public function createItem(CartItem $CartItem)
    {
        $class = $this->getClass();
        $item = new $class;
        $title = $CartItem->getProductSet()->getProduct()->getTitle();
        if($CartItem->getProductSet()->getProductSize()){
            $title.= ' '.$CartItem->getProductSet()->getProductSize()->getTitle();
        }
        if($CartItem->getProductSet()->getProductOption()){
            $title.= '/'.$CartItem->getProductSet()->getProductOption()->getTitle();
        }

        $item->setTitle($title);
		$item->setProductSet($CartItem->getProductSet());
		$item->setPrice($CartItem->getProductSet()->getProduct()->getStorePrice());
        $item->setQuantity($CartItem->getQuantity());
		return $item;
    }

    /**
     * {@inheritdoc}
     */
    public function persistItem(ItemInterface $order)
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(ItemInterface $order)
    {
        $this->entityManager->remove($order);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findItem($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findItemBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findItems()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findItemsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}