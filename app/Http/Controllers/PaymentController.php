<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PaymentController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment.gateway');
    }



    public function processPayment(Request $request)
    {
        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL); // Cambia a PRODUCTION en producción

        $client = new PaymentClient();

        try {
            $request_data = [
                "transaction_amount" => 100,
                "token" => $request->token,
                "description" => "Producto o servicio",
                "installments" => $request->installments ?? 1,
                "payment_method_id" => $request->payment_method_id,
                "payer" => [
                    "email" => $request->payer['email'],
                ]
            ];

            $request_options = new RequestOptions();
            $request_options->setCustomHeaders([
                "X-Idempotency-Key: " . uniqid()
            ]);

            $payment = $client->create($request_data, $request_options);

            return response()->json([
                'status' => 'success',
                'payment_id' => $payment->id
            ]);

        } catch (MPApiException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'api_response' => [
                    'status' => $e->getApiResponse()->getStatusCode(),
                    'content' => $e->getApiResponse()->getContent()
                ]
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }

}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
