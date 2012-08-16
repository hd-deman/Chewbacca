<?php

namespace Chewbacca\ProductPromoBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductPromoAdminController extends Controller
{
public function getProductsAction($brand_id)
    {

        $params = array();
        $params['country_id'] = 1;
        $params['brand_id'] = $brand_id;

        $product = $this->container->get('lacroco_store.product_manager')->findProductsBy($params);

        $products_arr = array();
        foreach ($product as $product) {
            $imgSrc = $this->container
                ->get('liip_imagine.controller')
                ->filterAction(
                    $this->getRequest(),
                    $product->getMainImage()->getWebPath(),
                    'lacroco_product_smallest'
                )
                ->headers->get('location');

            $products_arr[] = array(
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'img' => $imgSrc
            );
        }

        return new Response(json_encode($products_arr), 200);
    }
}
