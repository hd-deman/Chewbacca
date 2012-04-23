<?php

namespace Chewbacca\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChewbaccaUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
