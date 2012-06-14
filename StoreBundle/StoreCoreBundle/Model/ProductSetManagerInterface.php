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
    public function createSet();

    /**
     * Persists product set.
     *
     * @param ProductSet $product
     */
    public function persistSet(ProductSet $product);

    /**
     * Deletes product.
     *
     * @param ProductSet $product
     */
    public function removeSet(ProductSet $product);

    /**
     * Finds product set by id.
     *
     * @param integer $id
     *
     * @return ProductSet
     */
    public function findSet($id);

    /**
     * Finds product set by criteria.
     *
     * @param array $criteria
     *
     * @return ProductSet
     */
    public function findSetBy(array $criteria);

    /**
     * Finds all product sets.
     *
     * @return array
     */
    public function findSets();

    /**
     * Finds product sets by criteria.
     *
     * @param array $criteria
     *
     * @return array
     */
    public function findSetsBy(array $criteria);

    /**
     * Returns FQCN of product set.
     *
     * @return string
     */
    public function getClass();
}
