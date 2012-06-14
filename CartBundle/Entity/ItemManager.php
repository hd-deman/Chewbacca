<?php

namespace Chewbacca\CartBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Chewbacca\CartBundle\Entity\CartItem;
use Chewbacca\CartBundle\Model\ItemManager as BaseItemManager;

class ItemManager extends BaseItemManager
{
    /**
     * Entity Manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Items repository.
     *
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, $class)
    {
        parent::__construct($class);

        $this->entityManager = $entityManager;
        $this->repository    = $this->entityManager->getRepository($class);
    }

    /**
     * {@inheritdoc}
     */
    public function createItem()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function persistItem(CartItem $cart)
    {
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(CartItem $cart)
    {
        $this->entityManager->remove($cart);
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
        return $this->findBy($criteria);
    }
}
