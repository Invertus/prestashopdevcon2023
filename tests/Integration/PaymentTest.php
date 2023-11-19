<?php

namespace Invertus\Tests\Prestashopdevcon\Integration;

use Invertus\Prestashopdevcon\Services\PaymentProvider;
use Module;

class PaymentTest extends BaseTestCase
{
    public function testGetCardNames()
    {
        $module = Module::getInstanceByName('prestashopdevcon');

        /** @var PaymentProvider $paymentProvider */
        $paymentProvider = $module->get(PaymentProvider::class);

        $this->assertEquals(["Test card 1", "Test card 2"], $paymentProvider->getCardNames());
    }
}