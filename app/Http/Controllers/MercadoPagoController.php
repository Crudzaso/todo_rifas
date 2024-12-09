<?php

namespace App\Http\Controllers;

use App\Models\RaffleEntries;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
    protected $mercadoPagoService;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }

    public function createPaymentPreference(Request $request, $raffleEntryId)
    {
        $user = Auth::User();
        try {
            $raffleEntry = RaffleEntries::findOrFail($raffleEntryId);

            $payer=[
                "name" => $user->name,
                "email"=>$user->email,
            ];


            $preference = $this->mercadoPagoService->createPaymentPreference($raffleEntry,$payer);
          dd($preference);
            if ($preference) {
                $checkoutUrl = app()->environment('production')
                    ? $preference->init_point
                    : $preference->sandbox_init_point;

                return redirect($checkoutUrl);

            } else {

                return redirect()->back()->with('error', 'Unable to create payment preference. Please try again.');
            }
        } catch (\Exception $e) {
//            Log::error('Error creating MercadoPago payment preference: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function handleSuccess(Request $request, $raffleEntryId)
    {

        return view('success', ['raffleEntryId' => $raffleEntryId]);
    }

    public function handleFailure(Request $request, $raffleEntryId)
    {

        return view('failure', ['raffleEntryId' => $raffleEntryId]);
    }


}
