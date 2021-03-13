<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Tenolo\Bundle\FAQBundle\Entity as BundleEntity;
use Tenolo\Bundle\FAQBundle\Model\Interfaces as BundleInterfaces;

/**
 * @company tenolo GbR
 */
class TenoloFAQExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    /**
     * @inheritdoc
     */
    public function loadInternal(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('tenolo_faq.templates.faq.index', $configs['templates']['faq']['index']);
        $container->setParameter('tenolo_faq.templates.category.show', $configs['templates']['category']['show']);
        $container->setParameter('tenolo_faq.templates.question.most_recent', $configs['templates']['question']['most_recent']);
        $container->setParameter('tenolo_faq.templates.question.show', $configs['templates']['question']['show']);
    }

    public function prepend(ContainerBuilder $container): void
    {
        $container->prependExtensionConfig('doctrine', $this->getDoctrineConfig());
    }

    /**
     * @return mixed[]
     */
    protected function getDoctrineConfig(): array
    {
        return [
            'orm' => [
                'resolve_target_entities' => [
                    BundleInterfaces\CategoryInterface::class => BundleEntity\Category::class,
                    BundleInterfaces\QuestionInterface::class => BundleEntity\Question::class,
                ],
            ],
        ];
    }
}
