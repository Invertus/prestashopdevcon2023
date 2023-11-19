<?php

namespace Invertus\Tests\Prestashopdevcon\Integration;

use Invertus\Prestashopdevcon\Exception\ApiClientException;
use Invertus\Prestashopdevcon\Services\PaymentHandler;
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

    public function testCreatePayment_successful()
    {
        $module = Module::getInstanceByName('prestashopdevcon');

        /** @var PaymentHandler $paymentHandler */
        $paymentHandler = $module->get(PaymentHandler::class);

        $id = $paymentHandler->createPayment(5000);

        $this->assertEquals("asidjiasdn2123123", $id);
    }

    public function testCreatePayment_fail()
    {
        $this->expectException(ApiClientException::class);

        $module = Module::getInstanceByName('prestashopdevcon');

        /** @var PaymentHandler $paymentHandler */
        $paymentHandler = $module->get(PaymentHandler::class);

        $paymentHandler->createPayment(0);
    }
}