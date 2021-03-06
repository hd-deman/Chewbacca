<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Chewbacca\StoreBundle\StoreCoreBundle\Model\Product as ProductEntity;
use Chewbacca\StoreBundle\StoreCoreBundle\Model\ProductManager as BaseProductManager;
#use Chewbacca\StoreBundle\StoreCoreBundle\Sorting\SorterInterface;

/**
 * ORM driver product manager.
 * It handles model persistence with Doctrine ORM.
 * Also creates proper paginator instance for this driver.
 *
 */
class ProductManager extends BaseProductManager
{
    /**
     * Entity manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Product entity repository.
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
    public function createProduct()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function createPaginator($queryBuilder = null)
    {
        return new Pagerfanta(new DoctrineORMAdapter($queryBuilder->getQuery()->useResultCache(true, 10800)));
    }

    /**
     * {@inheritdoc}
     */
    public function persistProduct(ProductEntity $product)
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeProduct(ProductEntity $product)
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function findProduct($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findProductBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findProducts()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findProductsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function findProductsByWithPaginator(array $criteria)
    {
        return $this->createPaginator($this->getProductsQueryBuilderBy($criteria));
    }
}
