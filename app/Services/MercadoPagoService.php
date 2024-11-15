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



    // Paso 1: Autenticar al usuario con MercadoPago
    protected function authenticate() {
        $mpAccessToken = env(config('services.mercadopago.access-token'));
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL); // Opcional
    }


    // Paso 2: Crear la preferencia de pago para la rifa (con ticket o bet)
    public function createPaymentPreference(RaffleEntries $raffleEntry) {
        try {
            // Determinar el precio basado en el tipo de entrada (ticket o bet)
            $price = $raffleEntry->type === 'ticket' ? $raffleEntry->price : $raffleEntry->bet_amount;

            // Crear los datos de la rifa como un "producto virtual"
            $items = [
                [
                    "id" => $raffleEntry->id, // ID único de la rifa
                    "title" => "Entrada Rifa ID {$raffleEntry->id}", // Nombre de la rifa
                    "description" => "Participación en la rifa",
                    "currency_id" => "ARS", // Cambia la moneda si es necesario
                    "quantity" => 1,
                    "unit_price" => $price // El valor de la entrada (ticket o bet)
                ]
            ];

            // Datos del comprador (usuario)
            $payer = [
                "name" => 'fernando',
                "surname" => 'narc',
                "email" => 'nando@gmail.co',
            ];

            // Configuración de los métodos de pago
            $paymentMethods = [
                "excluded_payment_methods" => [],
                "installments" => 1, // Pagos en cuotas, puedes ajustar esto
                "default_installments" => 1, // Instalación por defecto
            ];

            // URLs para redirigir después del pago
            $backUrls = [
                'success' => route('mercadopago.success', ['raffleEntry' => $raffleEntry->id]),
                'failure' => route('mercadopago.failed', ['raffleEntry' => $raffleEntry->id]),
            ];

            // Crear la solicitud de preferencia
            $request = [
                "items" => $items,
                "payer" => $payer,
                "payment_methods" => $paymentMethods,
                "back_urls" => $backUrls,
                "statement_descriptor" => "Rifa Online",
                "external_reference" => "raffle-entry-{$raffleEntry->id}",
                "expires" => false,
                "auto_return" => 'approved', // Regresa automáticamente si el pago es aprobado
            ];

            // Crear cliente de preferencia y crear la preferencia en MercadoPago
            $client = new PreferenceClient();
            $preference = $client->create($request);

            // Retornar la URL del checkout
            return $preference->init_point;

        } catch (MPApiException $error) {
            // Manejo de errores
            return null;
        }
    }


}
