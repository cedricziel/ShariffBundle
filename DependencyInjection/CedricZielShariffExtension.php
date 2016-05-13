<?php

namespace CedricZiel\ShariffBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CedricZielShariffExtension extends Extension
{
    /**
     * @return string
     */
    public function getAlias()
    {
        return 'cedricziel_shariff';
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('cedricziel_shariff.shariff_config.domain', $config['domain']);
        $container->setParameter('cedricziel_shariff.shariff_config.force_protocol', $config['force_protocol']);
        $container->setParameter('cedricziel_shariff.shariff_config.cache', $config['cache']);
        $container->setParameter('cedricziel_shariff.shariff_config.services', $config['services']);
        $container->setParameter('cedricziel_shariff.shariff_config.client', $config['client']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
