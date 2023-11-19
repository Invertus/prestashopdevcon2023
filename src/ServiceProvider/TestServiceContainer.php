<?php

namespace Invertus\Prestashopdevcon\ServiceProvider;

use Invertus\Prestashopdevcon\PaymentApiClient\PaymentApiClient;
use Invertus\Prestashopdevcon\PaymentApiClient\PaymentApiClientInterface;
use League\Container\Container;

class TestServiceContainer
{
    public function register(Container $container)
    {
        $container->add(PaymentApiClientInterface::class, function () {
            return new PaymentApiClient("http://172.17.0.1:8443");
        });
    }
}