<?php

namespace Invertus\Prestashopdevcon\ServiceProvider;

use League\Container\Container;
use League\Container\ReflectionContainer;

final class ServiceProvider implements ServiceProviderInterface
{
    public function getService($serviceName)
    {
        $container = new Container();
        $container->delegate(
            new ReflectionContainer()
        );

        (new ServiceContainer())->register($container);

        if ($_ENV['app_env'] === 'ci') {
            (new TestServiceContainer())->register($container);
        }

        return $container->get((string) $serviceName);
    }
}