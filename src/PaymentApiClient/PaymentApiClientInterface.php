<?php

namespace Invertus\Prestashopdevcon\PaymentApiClient;

interface PaymentApiClientInterface
{
    /**
     * @return array
     */
    public function getCreditCards();

    /**
     * @param int $amount
     * @return string
     */
    public function pay($amount);
}