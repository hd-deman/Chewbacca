<?php

namespace Chewbacca\SitemapBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Chewbacca\SitemapBundle\DependencyInjection\Compiler\SitemapGeneratorPass;
class ChewbaccaSitemapBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SitemapGeneratorPass());
    }
}
