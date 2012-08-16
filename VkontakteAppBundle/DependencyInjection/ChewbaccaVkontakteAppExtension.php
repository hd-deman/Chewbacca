<?php

namespace Chewbacca\VkontakteAppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ChewbaccaVkontakteAppExtension extends Extension
{
    protected $resources = array(
        'vkontakte_app' => 'vkontakte_app.yml',
    );

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loadDefaults($container);

        if (isset($config['alias'])) {
            $container->setAlias($config['alias'], 'chewbacca_vkontakte_app');
        }

        foreach (array('classes_dir', 'client_id', 'client_secret') as $attribute) {
            if (isset($config[$attribute])) {
                $container->setParameter('chewbacca_vkontakte_app.'.$attribute, $config[$attribute]);
            }
        }
    }

    protected function loadDefaults($container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config', __DIR__.'/Resources/config')));

        foreach ($this->resources as $resource) {
            $loader->load($resource);
        }
    }
}
