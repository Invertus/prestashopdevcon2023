<?php

namespace Invertus\Prestashopdevcon\PaymentApiClient;

use Invertus\Prestashopdevcon\Exception\ApiClientException;
use Unirest\Request;

final class PaymentApiClient implements PaymentApiClientInterface
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getCreditCards()
    {
        $response = Request::get(
            "{$this->baseUrl}/cards",
            [
                "Content-Type" => "application/json"
            ]
        );

        if ($response->code !== 200) {
            throw new ApiClientException("Failed to get cards. Code: {$response->code}, message: {$response->raw_body}");
        }

        return json_decode($response->raw_body, true);
    }

    public function pay($amount)
    {
        $response = Request::post(
            "{$this->baseUrl}/pay",
            [
                [
                    "Content-Type" => "application/json"
                ]
            ],
            [
                "amount" => $amount
            ]
        );

        if ($response->code !== 201) {
            throw new ApiClientException("Failed to make payment. Code: {$response->code}, message: {$response->raw_body}");
        }

        return json_decode($response->raw_body, true)['id'];
    }
}