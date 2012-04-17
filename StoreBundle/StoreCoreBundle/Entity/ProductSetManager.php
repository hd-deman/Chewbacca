<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet;
use Chewbacca\StoreBundle\StoreCoreBundle\Model\ProductSetManager as BaseProductSetManager;

/**
 * ORM driver product set manager.
 * It handles model persistence with Doctrine ORM.
 *
 */
class ProductSetManager extends BaseProductSetManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Product Set entity repository.
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
        $this->repository = $entityManager->getRepository($this->getClass());
    }

    /**
     * {@inheritdoc}
     */
    public function createSet()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function persistSet(ProductSet $product)
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeSet(ProductSet $product)
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findSet($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findSetBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findSets()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findSetsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}