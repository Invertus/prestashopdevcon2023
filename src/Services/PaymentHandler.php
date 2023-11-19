<?php

namespace Invertus\Prestashopdevcon\Services;

use Invertus\Prestashopdevcon\PaymentApiClient\PaymentApiClientInterface;

class PaymentHandler
{
    /**
     * @var PaymentApiClientInterface
     */
    private $apiClient;

    public function __construct(PaymentApiClientInterface $apiClient)
    {
        $this->apiClient = $apiClient;
    }


    public function createPayment($amountCents)
    {
        // in real app, some prestashop logic should be located here
        return $this->apiClient->pay($amountCents);
    }
}