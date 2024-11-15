<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Resources\Customer\Issuer;

class IssuerController extends Controller
{

    public function getIssuers($id)
    {
        try {
            // Aquí puedes verificar si realmente tienes datos con la consulta
            $issuers = Issuer::where('some_column', $id)->get();

            // Si no hay emisores, devuelve un mensaje de error
            if ($issuers->isEmpty()) {
                return response()->json(['message' => 'No issuers found'], 404);
            }

            // Devuelve los emisores si los encontró
            return response()->json($issuers);
        } catch (\Exception $e) {
            \Log::error('Error al obtener emisores: ' . $e->getMessage());
            return response()->json(['message' => 'Error al obtener emisores'], 500);
        }

    }

}
