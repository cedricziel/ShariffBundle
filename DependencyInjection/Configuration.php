<?php

namespace CedricZiel\ShariffBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cedricziel_shariff');

        $rootNode
            ->children()
                ->scalarNode('domain')->isRequired()->end()
                ->scalarNode('force_protocol')->defaultNull()->end()
                ->arrayNode('cache')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('cacheDir')->defaultNull()->end()
                        ->scalarNode('ttl')->defaultValue(1800)->end()
                        ->scalarNode('adapter')->defaultNull()->end()
                        ->arrayNode('adapterOptions')
                            ->useAttributeAsKey('name')
                            ->prototype('variable')
                                ->validate()
                                    ->ifTrue(function($v) { return !is_array($v) && !is_null($v); })
                                    ->thenInvalid('The services config %s must be either null or an array.')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('services')
                    ->useAttributeAsKey('name')
                    ->prototype('variable')
                        ->validate()
                            ->ifTrue(function($v) { return !is_array($v) && !is_null($v); })
                            ->thenInvalid('The services config %s must be either null or an array.')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('client')
                    ->useAttributeAsKey('name')
                    ->prototype('variable')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
