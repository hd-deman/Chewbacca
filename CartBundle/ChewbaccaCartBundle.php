<?php
namespace Chewbacca\CartBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChewbaccaCartBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'VespolinaCartBundle';
    }
}