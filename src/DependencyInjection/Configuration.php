<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DependencyInjection;

use Dbp\Relay\BaseCourseBundle\DataProvider\CourseDataProvider;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbp_relay_base_course');

        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        CourseDataProvider::appendConfigNodeDefinitions($rootNode);

        return $treeBuilder;
    }
}
