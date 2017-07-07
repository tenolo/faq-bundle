<?php

namespace Tenolo\Bundle\FAQBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Tenolo\Bundle\FAQBundle\DependencyInjection
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tenolo_faq');

        $rootNode
            ->children()
                ->arrayNode('templates')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('faq')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('index')->defaultValue('TenoloFAQBundle:Faq:index.html.twig')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                        ->arrayNode('category')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('show')->defaultValue('TenoloFAQBundle:Category:show.html.twig')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                        ->arrayNode('question')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('show')->defaultValue('TenoloFAQBundle:Question:show.html.twig')->cannotBeEmpty()->end()
                                ->scalarNode('most_recent')->defaultValue('TenoloFAQBundle:Question:most_recent.html.twig')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
