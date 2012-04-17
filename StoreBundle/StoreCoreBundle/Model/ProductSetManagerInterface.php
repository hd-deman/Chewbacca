<?php

namespace Chewbacca\StoreBundle\StoreCoreBundle\Model;

use Chewbacca\StoreBundle\StoreCoreBundle\Entity\ProductSet;

/**
 * Product Set manager interface.
 *
 */
interface ProductSetManagerInterface
{
    /**
     * Creates new product object.
     *
     * @return Set
     */
    function createSet();

    /**
     * Persists product set.
     *
     * @param ProductSet $product
     */
    function persistSet(ProductSet $product);

    /**
     * Deletes product.
     *
     * @param ProductSet $product
     */
    function removeSet(ProductSet $product);

    /**
     * Finds product set by id.
     *
     * @param integer $id
     *
     * @return ProductSet
     */
    function findSet($id);

    /**
     * Finds product set by criteria.
     *
     * @param array $criteria
     *
     * @return ProductSet
     */
    function findSetBy(array $criteria);

    /**
     * Finds all product sets.
     *
     * @return array
     */
    function findSets();

    /**
     * Finds product sets by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    function findSetsBy(array $criteria);

    /**
     * Returns FQCN of product set.
     *
     * @return string
     */
    function getClass();
}