<?php
namespace Chewbacca\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SitemapGeneratorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('chewbacca_sitemap.generator_chain')) {
            return;
        }

        $definition = $container->getDefinition('chewbacca_sitemap.generator_chain');

        foreach ($container->findTaggedServiceIds('chewbacca.sitemap_generator') as $id => $attributes) {
            $definition->addMethodCall('addGenerator', array(new Reference($id)));
        }
    }
}
