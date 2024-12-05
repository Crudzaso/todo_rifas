<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Models\RaffleEntries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{

    private $merchantId;
    private $accountId;
    private $apiKey;
    private $apiLogin;
    private $isTest;
    private $payuBaseUrl;

    public function __construct()
    {
        $this->merchantId = config('services.payu.merchant_id');
        $this->accountId = config('services.payu.account_id');
        $this->apiKey = config('services.payu.api_key');
        $this->apiLogin = config('services.payu.api_login');
        $this->isTest = config('services.payu.is_test', true);
        $this->payuBaseUrl = $this->isTest
            ? 'https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi'
            : 'https://api.payulatam.com/payments-api/4.0/service.cgi';
    }



    public function createPayment(CreatePaymentRequest $request,RaffleEntries $raffleEntry)
    {



        $referenceCode = 'RIFA_' . Str::random(8);
        $description = 'Compra de boleto(s) de rifa';
        $amount = number_format($request->amount, 2, '.', '');
        $ticketId = $raffleEntry->id;

        $signature = hash('md5',
            $this->apiKey . '~' .
            $this->merchantId . '~' .
            $referenceCode . '~' .
            $amount . '~COP'
        );


        $payerData = [
            'fullName' => $request->name,
            'emailAddress' => $request->email,
            'contactPhone' => '57 3007777777',

        ];



        $data = [
            'language' => 'es',
            'command' => 'SUBMIT_TRANSACTION',
            'merchant' => [
                'apiKey' => $this->apiKey,
                'apiLogin' => $this->apiLogin
            ],
            'transaction' => [
                'order' => [
                    'accountId' => $this->accountId,
                    'referenceCode' => $referenceCode,
                    'description' => $description,
                    'language' => 'es',
                    'signature' => $signature,
                    'notifyUrl' => route('payu.notification'),
                    'additionalValues' => [
                        'TX_VALUE' => [
                            'value' => $amount,
                            'currency' => 'COP'
                        ]
                    ]
                ],
                'payer' => $payerData,
                'type' => 'AUTHORIZATION_AND_CAPTURE',
                'paymentMethod' => 'NEQUI_WALLET',
                'paymentCountry' => 'CO',
                'deviceSessionId' => session()->getId(),
                'ipAddress' => $request->ip(),
                'userAgent' => $request->header('User-Agent')
            ],
            'test' => $this->isTest
        ];


        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($this->payuBaseUrl, $data);

            $result = $response->json();
            if ($response->successful()) {
                $result = $response->json(); // Decodifica el JSON de la respuesta
                dd($result); // Muestra el resultado
            } else {
                // Si la respuesta no es exitosa, muestra el contenido de la respuesta y el error
                dd($response->status(), $response->body());
            }
            if ($response->successful() && isset($result['transactionResponse']['extraParameters']['BANK_URL'])) {
                return redirect($result['transactionResponse']['extraParameters']['BANK_URL']);
            }

            \Log::error('PayU Payment Error', [
                'response' => $result,
                'status' => $response->status()
            ]);

            return back()->with('error', 'No se pudo iniciar el pago con Nequi.');
        } catch (\Exception $e) {
            \Log::error('PayU Payment Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Ocurrió un error al procesar el pago.');
        }
    }

    public function handleNotification(Request $request)
    {
        $signature = $request->input('sign');
        $expectedSignature = md5($this->apiKey . '~' . $request->input('merchant_id') . '~' . $request->input('reference_sale') . '~' . $request->input('value') . '~' . $request->input('currency') . '~' . $request->input('state_pol'));

        if ($signature !== $expectedSignature) {
            return response('Invalid signature', 400);
        }

        // Actualiza el estado del pago en tu base de datos
        // Por ejemplo:
        // $transaction = Transaction::where('reference', $request->input('reference_sale'))->first();
        // if ($transaction) {
        //     $transaction->status = $this->mapPayUStatus($request->input('state_pol'));
        //     $transaction->save();
        // }

        return response('OK', 200);
    }

    public function handlePaymentSuccess(RaffleEntries $raffleEntry)
    {
        // Mark raffle entry as paid
        $raffleEntry->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);

        // Optional: Create transaction record
        // Transaction::create([...]);

        // Redirect with success message
        return redirect()->route('raffles.index')
            ->with('success', 'Pago realizado exitosamente. Tu número de rifa ha sido registrado.');
    }
    private function mapPayUStatus($payuStatus)
    {
        $statusMap = [
            '4' => 'APPROVED',
            '6' => 'DECLINED',
            '5' => 'EXPIRED',
            '7' => 'PENDING',
        ];

        return $statusMap[$payuStatus] ?? 'UNKNOWN';
    }
}
