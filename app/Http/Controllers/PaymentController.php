<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\RaffleEntries;
//use App\Services\MercadoPagoService;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class PaymentController extends Controller
//{
//    // Método para iniciar el pago
//    public function pay(RaffleEntries $raffleEntry) {
//
//        $mercadoPagoService = new MercadoPagoService();
//        $checkoutUrl = $mercadoPagoService->createPaymentPreference($raffleEntry);
//
//        if ($checkoutUrl) {
//            return redirect($checkoutUrl); // Redirige al usuario al checkout
//        } else {
//            return back()->withErrors("Error al procesar el pago.");
//        }
//    }
//
//    // Método para manejar la respuesta exitosa
//    public function success(Request $request, RaffleEntries $raffleEntry) {
//        return view('mercadopago.success', ['raffleEntry' => $raffleEntry]);
//    }
//
//    // Método para manejar la respuesta fallida
//    public function failed(Request $request, RaffleEntries $raffleEntry) {
//        return view('mercadopago.failed', ['raffleEntry' => $raffleEntry]);
//    }
//}
