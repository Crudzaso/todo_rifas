<?php

namespace App\Services;

use App\Models\RaffleEntries;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Payment;
use MercadoPago\Resources\Preference;
use MercadoPago\Resources\Preference\Item;

class MercadoPagoService
{
    public function __construct()
    {
        $this->authenticate();
    }




    protected function authenticate() {
        try {
            $mpAccessToken = config('services.mercadopago.access-token');
            var_dump(env('MP_ACCESS_TOKEN'));


            \Log::info('Token MercadoPago: ' . $mpAccessToken);

            if (empty($mpAccessToken)) {
                throw new \Exception('Token de acceso vacío');
            }

            MercadoPagoConfig::setAccessToken($mpAccessToken);
        } catch (\Exception $e) {

            \Log::error('Error de autenticación MercadoPago: ' . $e->getMessage());
            throw $e;
        }
    }


    public function createPaymentPreference(RaffleEntries $raffleEntry,$payer) {
        try {

            $price = $raffleEntry->type === 'ticket' ? $raffleEntry->price : $raffleEntry->bet_amount;


            $items = [
                [
                    "id" => $raffleEntry->id,
                    "title" => "Entrada Rifa ID {$raffleEntry->id}",
                    "description" => "Participación en la rifa",
                    "currency_id" => "COP",
                    "quantity" => 1,
                    "unit_price" => $price
                ]
            ];



            // Datos del comprador (usuario)
//            $payer = [
//                "name" => 'fernando',
//                "surname" => 'narc',
//                "email" => 'nando@gmail.co',
//            ];


            $paymentMethods = [
                "excluded_payment_methods" => [],
                "installments" => 12,
                "default_installments" => 1,
            ];




            $backUrls = [
                'success' => route('mercadopago.success', ['raffleEntry' => $raffleEntry->id]),
                'failure' => route('mercadopago.failure', ['raffleEntry' => $raffleEntry->id]),

            ];



            $request = [
                "items" => $items,
                "payer" => $payer,
                "payment_methods" => $paymentMethods,
                "back_urls" => $backUrls,
                "statement_descriptor" => "Rifa Online",
                "external_reference" => "raffle-entry-{$raffleEntry->id}",
                "expires" => false,
                "auto_return" => 'approved',
            ];
            dd($request);


            $client = new PreferenceClient();
            $preference = $client->create($request);


            return $preference;

        }catch (MPApiException $error) {
            \Log::error('Error al crear preferencia de pago: ' . $error->getMessage());
            throw new \Exception('No se pudo crear la preferencia de pago: ' . $error->getMessage());
        }
    }


}
