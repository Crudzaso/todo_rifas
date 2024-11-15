<?php

namespace App\Services;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoService{
    public function createPayment(array $data): array
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
        $client = new PaymentClient();
        $requestOptions = new RequestOptions();
        $requestOptions->setCustomHeaders([
            "X-Idempotency-Key" => uniqid(),
        ]);

        $payment = $client->create([
            "transaction_amount" => (float) $data['transaction_amount'],
            "token" => $data['token'],
            "description" => $data['description'],
            "installments" => 1,
            "payment_method_id" => $data['payment_method_id'],
            "issuer_id" => $data['issuer'],
            "payer" => [
                "email" => $data['email'],
                "identification" => [
                    "type" => $data['identification_type'],
                    "number" => $data['identification_number'],
                ],
            ],
        ], $requestOptions);

        return [
            'id' => $payment->id,
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'transaction_amount' => $payment->transaction_amount,
            'payment_method_id' => $payment->payment_method_id,
            'payer' => [
                'email' => $payment->payer->email,
                'identification' => [
                    'type' => $payment->payer->identification->type,
                    'number' => $payment->payer->identification->number,
                ],
            ],
        ];
    }
}
