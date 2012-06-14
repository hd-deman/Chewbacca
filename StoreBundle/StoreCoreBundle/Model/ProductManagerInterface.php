<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Model;

use Chewbacca\StoreBundle\StoreCoreBundle\Model\Product as ProductEntity;
#use Chewbacca\StoreBundle\StoreCoreBundle\SorterInterface;

/**
 * Product manager interface.
 *
 */
interface ProductManagerInterface
{
    /**
     * Creates new product object.
     *
     * @return Product
     */
    public function createProduct();

    /**
     * Creates paginator.
     *
     * @param SorterInterface $sorter
     */
    public function createPaginator($queryBuilder = null);

    /**
     * Persists product.
     *
     * @param Product $product
     */
    public function persistProduct(ProductEntity $product);

    /**
     * Deletes product.
     *
     * @param Product $product
     */
    public function removeProduct(ProductEntity $product);

    /**
     * Finds product by id.
     *
     * @param integer $id
     *
     * @return Product
     */
    public function findProduct($id);

    /**
     * Finds product by criteria.
     *
     * @param array $criteria
     *
     * @return Product
     */
    public function findProductBy(array $criteria);

    /**
     * Finds all products.
     *
     * @return array
     */
    public function findProducts();

    /**
     * Finds products by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    public function findProductsBy(array $criteria);

    /**
     * Returns FQCN of product.
     *
     * @return string
     */
    public function getClass();
}
