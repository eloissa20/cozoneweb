<?php

namespace App\Services;

use GuzzleHttp\Client;

class PayMongoService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.paymongo.com/v1/',
            'auth' => [env('PAYMONGO_SECRET_KEY'), ''],
        ]);
    }

    public function createGCashSource($amount, $currency = 'PHP', $redirect = [])
    {
        $response = $this->client->post('sources', [
            'json' => [
                'data' => [
                    'attributes' => [
                        'amount' => $amount, // Amount in centavos
                        'type' => 'gcash',
                        'currency' => $currency,
                        'redirect' => $redirect,
                    ],
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
