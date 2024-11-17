<?php

namespace App\Http\Controllers;

use App\Models\RaffleEntries;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Método para iniciar el pago
    public function pay(RaffleEntries $raffleEntry) {
        // Paso 1: Obtener el usuario autenticado
//        $user = Auth::user();
//
//        if ($user === null) {
//            // Si no está autenticado, redirige o muestra un mensaje de error
//            return redirect()->route('login')->with('error', 'Por favor, inicia sesión para proceder.');
//        }

        // Paso 2: Crear la preferencia de pago para la rifa
        $mercadoPagoService = new MercadoPagoService();
        $checkoutUrl = $mercadoPagoService->createPaymentPreference($raffleEntry);

        // Paso 3: Redirigir al usuario a la página de pago de MercadoPago
        if ($checkoutUrl) {
            return redirect($checkoutUrl); // Redirige al usuario al checkout
        } else {
            return back()->withErrors("Error al procesar el pago.");
        }
    }

    // Método para manejar la respuesta exitosa
    public function success(Request $request, RaffleEntries $raffleEntry) {
        // Aquí puedes manejar la respuesta después de que el pago fue exitoso
        return view('mercadopago.success.blade.php', ['raffleEntry' => $raffleEntry]);
    }

    // Método para manejar la respuesta fallida
    public function failed(Request $request, RaffleEntries $raffleEntry) {
        // Aquí puedes manejar la respuesta cuando el pago falla
        return view('mercadopago.failed', ['raffleEntry' => $raffleEntry]);
    }
}
