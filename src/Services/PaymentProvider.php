<?php

namespace Invertus\Prestashopdevcon\Services;

use Invertus\Prestashopdevcon\PaymentApiClient\PaymentApiClientInterface;

class PaymentProvider
{
    /**
     * @var PaymentApiClientInterface
     */
    private $apiClient;

    public function __construct(PaymentApiClientInterface $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getCardNames()
    {
        $cards = $this->apiClient->getCreditCards();

        return array_map(function ($item) { return $item['name']; }, $cards);
    }
}