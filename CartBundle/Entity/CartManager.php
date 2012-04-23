<?php

namespace Chewbacca\CartBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Chewbacca\CartBundle\Entity\Cart;
use Chewbacca\CartBundle\Model\CartManager as BaseCartManager;

/**
 * Cart manager for doctrine/orm driver.
 *
 */
class CartManager extends BaseCartManager
{
    /**
     * Entity Manager.
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Carts repository.
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
        $this->repository = $this->entityManager->getRepository($class);
    }

    /**
     * {@inheritdoc}
     */
    public function createCart()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function persistCart(Cart $cart)
    {
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeCart(Cart $cart)
    {
        $this->entityManager->remove($cart);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function flushCarts()
    {
        $expiredCarts = $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from($this->getClass(), 'c')
            ->where('c.locked = false AND c.expiresAt < ?1')
            ->setParameter(1, new \DateTime("now"))
            ->getQuery()
            ->getResult()
        ;

        foreach ($expiredCarts as $cart) {
            $this->removeCart($cart);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findCart($id)
    {
        return $this->repository->find($id);
    }

   public function findCartWithItems($id)
    {
        $qb = $this->repository->createQueryBuilder('cart');
        return $qb
            ->select('cart, item, p_set, p', 'img', 'cur', 'delivery_price')
            ->leftJoin('cart.cart_items', 'item')
            ->leftJoin('item.product_set', 'p_set')
            ->leftJoin('p_set.product', 'p')
            ->innerJoin('p.product_images', 'img')
            ->innerJoin('p.currency', 'cur')
            ->leftJoin('p.delivery_prices', 'delivery_price')
            ->where($qb->expr()->eq('img.priority',0))
            ->andWhere('cart.id = ?1')
            ->andWhere('delivery_price.country = :country_id')
            ->setParameter('country_id', 1)
            ->setParameter(1, $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findCartBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findCarts()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findCartsBy(array $criteria)
    {
        return $this->findBy($criteria);
    }
}
    