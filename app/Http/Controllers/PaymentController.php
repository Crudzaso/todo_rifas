<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\RaffleEntries;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Customer\Issuer;

class PaymentController extends Controller
{


    protected $mercadoPagoService;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($raffleId)
    {
        $user = Auth::user();
        $raffle = RaffleEntries::findOrFail($raffleId);
        $amount = $raffle->type === 'ticket' ? $raffle->price : $raffle->bet_amount;

        return view('payment.gateway',compact('user','amount'));
    }


    public function processPayment(Request $request)
    {

        $payment = $this->mercadoPagoService->createPayment($request->validated());
        return response()->json($payment);

    }

}
