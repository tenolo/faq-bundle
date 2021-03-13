<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @company tenolo GbR
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('tenolo_faq');
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('templates')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('faq')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('index')->defaultValue('@TenoloFAQ/Faq/index.html.twig')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                        ->arrayNode('category')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('show')->defaultValue('@TenoloFAQ/Category/show.html.twig')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                        ->arrayNode('question')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('show')->defaultValue('@TenoloFAQ/Question/show.html.twig')->cannotBeEmpty()->end()
                                ->scalarNode('most_recent')->defaultValue('@TenoloFAQ/Question/most_recent.html.twig')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
