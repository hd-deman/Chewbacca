<?php

namespace Chewbacca\CartBundle\Resolver;

use Chewbacca\CartBundle\Model\ItemInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Resolver returns cart item that needs to be added based on request.
 * Should be called only when adding/removing items.
 *
 */
interface ItemResolverInterface
{
    /**
     * Returns item to add.
     *
     * @param Request $request
     *
     * @return ItemInterface
     */
    public function resolveItemToAdd(Request $request);

    /**
     * Returns item to remove.
     *
     * @param Request $request
     *
     * @return ItemInterface
     */
    public function resolveItemToRemove(Request $request);
}
