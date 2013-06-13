<?php

namespace Wysow\ArchiveMyTweetsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class WysowArchiveMyTweetsExtension extends Extension
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

        $container->setParameter('wysow_archive_my_tweets.twitter.username',
            $config['twitter']['username']);

        $container->setParameter('wysow_archive_my_tweets.twitter.name',
            $config['twitter']['name']);

        $container->setParameter('wysow_archive_my_tweets.gravatar.email',
            $config['gravatar']['email']);
    }
}
