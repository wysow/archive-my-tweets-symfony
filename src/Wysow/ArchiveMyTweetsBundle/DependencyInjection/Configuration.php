<?php

namespace Wysow\ArchiveMyTweetsBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('wysow_archive_my_tweets');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->arrayNode('twitter')
                    ->children()
                        ->variableNode('username')->isRequired()->end()
                        ->variableNode('name')->isRequired()->end()
                    ->end()
                ->end()
                ->arrayNode('gravatar')
                    ->children()
                        ->variableNode('email')->isRequired()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
