<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Model;

use Chewbacca\StoreBundle\StoreCoreBundle\Model\Product;
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
    function createProduct();

    /**
     * Creates paginator.
     *
     * @param SorterInterface $sorter
     */
    function createPaginator($queryBuilder = null);

    /**
     * Persists product.
     *
     * @param Product $product
     */
    function persistProduct(Product $product);

    /**
     * Deletes product.
     *
     * @param Product $product
     */
    function removeProduct(Product $product);

    /**
     * Finds product by id.
     *
     * @param integer $id
     *
     * @return Product
     */
    function findProduct($id);

    /**
     * Finds product by criteria.
     *
     * @param array $criteria
     *
     * @return Product
     */
    function findProductBy(array $criteria);

    /**
     * Finds all products.
     *
     * @return array
     */
    function findProducts();

    /**
     * Finds products by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    function findProductsBy(array $criteria);

    /**
     * Returns FQCN of product.
     *
     * @return string
     */
    function getClass();
}