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
            return new PaymentApiClient($_ENV['PAYMENT_API_TEST_BASE_URL']);
        });
    }
}