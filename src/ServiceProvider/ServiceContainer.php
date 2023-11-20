<?php

namespace Invertus\Prestashopdevcon\ServiceProvider;

use Invertus\Prestashopdevcon\PaymentApiClient\PaymentApiClient;
use Invertus\Prestashopdevcon\PaymentApiClient\PaymentApiClientInterface;
use League\Container\Container;

class ServiceContainer
{
    public function register(Container $container)
    {
        $container->add(PaymentApiClientInterface::class, function () {
            return new PaymentApiClient("https://dummy.restapiexample.com/");
        });
    }
}