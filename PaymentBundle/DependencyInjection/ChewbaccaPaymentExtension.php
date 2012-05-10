<?php

namespace Chewbacca\PaymentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ChewbaccaPaymentExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if (!isset($config['qiwi']['login'])) {
            throw new \InvalidArgumentException('The "qiwi_login" option must be set');
        }
        if (!isset($config['qiwi']['password'])) {
            throw new \InvalidArgumentException('The "qiwi_password" option must be set');
        }
        $container->setParameter('chebacca_payment.qiwi.login', $config['qiwi']['login']);
        $container->setParameter('chebacca_payment.qiwi.password', $config['qiwi']['password']);

    }
}
