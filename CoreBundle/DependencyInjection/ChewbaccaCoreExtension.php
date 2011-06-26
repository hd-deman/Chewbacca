<?php

namespace Chewbacca\CoreBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class ChewbaccaCoreExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $definition = new Definition('Chewbacca\CoreBundle\Twig\CoreExtension');
        // this is the most important part. Later in the startup process TwigBundle
        // searches through the container and registres all services taged as twig.extension.
        $definition->addTag('twig.extension');
        $container->setDefinition('core_extension', $definition);
    }

    public function getAlias()
    {
        return 'chewbacca_core';
    }
}
