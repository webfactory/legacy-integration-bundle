<?php

namespace Webfactory\Bundle\LegacyIntegrationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class CollectFilterPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        $kernelEventListenerDefinition = $container->getDefinition('webfactory_legacy_integration.kernel_event_listener');

        foreach ($container->findTaggedServiceIds('webfactory_legacy_integration.filter') as $id => $tags) {
            $kernelEventListenerDefinition->addMethodCall('addFilter', array(
                new Reference($id)
            ));
        }
    }

}