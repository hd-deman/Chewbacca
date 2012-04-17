<?php

namespace Chewbacca\CartBundle\Resolver;

use Chewbacca\CartBundle\Model\ItemManagerInterface;
use Chewbacca\CartBundle\Resolver\ItemResolverInterface;
use Chewbacca\StoreBundle\StoreCoreBundle\Model\ProductSetManagerInterface;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * Item resolver for cart bundle.
 * Returns proper item objects for cart add and remove actions.
 *
 */
class ItemResolver implements ItemResolverInterface
{
    /**
     * Item manager.
     *
     * @var ItemManagerInterface
     */
    private $itemManager;

    /**
     * Product Set manager.
     *
     * @var ProductSetManagerInterface
     */
    private $productSetManager;

    /**
     * Form factory.
     *
     * @var FormFactory
     */
    private $formFactory;

    /**
     * Constructor.
     *
     * @param ItemManagerInterface    $itemManager
     * @param ProductManagerInterface $productManager
     */
    public function __construct(ItemManagerInterface $itemManager, ProductSetManagerInterface $productSetManager, FormFactory $formFactory)
    {
        $this->itemManager = $itemManager;
        $this->productSetManager = $productSetManager;
        $this->formFactory = $formFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function resolveItemToAdd(Request $request)
    {
        /*
         * We're getting here product set id via query but you can easily override route
         * pattern and use attributes, which are available through request object.
         */
        if ($id = $request->query->get('id')) {
            if ($product_set = $this->productSetManager->findSet($id)) {
                /*
                 * To have it flexible, we allow adding single item by GET request
                 * and also user can provide desired quantity by form via POST request.
                 */
                $item = $this->itemManager->createItem();
                $item->setProductSet($product_set);

                if ('POST' === $request->getMethod()) {
                    $form = $this->formFactory->create('sylius_cart_item');
                    $form->setData($item);
                    $form->bindRequest($request);

                    if (!$form->isValid()) {

                        return false;
                    }
                }

                return $item;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function resolveItemToRemove(Request $request)
    {
        if ($id = $request->query->get('id')) {
            return $this->itemManager->findItem($id);
        }
    }
}
