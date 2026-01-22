<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DependencyInjection;

use Dbp\Relay\BaseCourseBundle\DataProvider\CourseClassDataProvider;
use Dbp\Relay\BaseCourseBundle\DataProvider\CourseDataProvider;
use Dbp\Relay\CoreBundle\Extension\ExtensionTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class DbpRelayBaseCourseExtension extends ConfigurableExtension
{
    use ExtensionTrait;

    public function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $this->addResourceClassDirectory($container, __DIR__.'/../Entity');

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $definition = $container->getDefinition(CourseDataProvider::class);
        $definition->addMethodCall('setConfig', [$mergedConfig]);

        $definition = $container->getDefinition(CourseClassDataProvider::class);
        $definition->addMethodCall('setConfig', [$mergedConfig]);
    }
}
