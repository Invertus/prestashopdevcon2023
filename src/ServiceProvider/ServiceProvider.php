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



        return $container->get((string) $serviceName);
    }
}