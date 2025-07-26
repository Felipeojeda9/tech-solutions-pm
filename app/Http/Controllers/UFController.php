<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class UFController extends Controller
{
    /**
     * Retorna el valor de la UF del día en formato JSON.
     */
    public function today(): JsonResponse
    {
        // Llamada al servicio de mindicador.cl
        $response = Http::get('https://mindicador.cl/api/uf');

        if (! $response->ok()) {
            return response()->json([
                'error' => 'No se pudo obtener el valor de la UF'
            ], 502);
        }

        $data = $response->json();

        // Extraemos solo la propiedad que necesitamos
        return response()->json([
            'valor'     => $data['serie'][0]['valor'],
            'fecha'     => $data['serie'][0]['fecha'],
        ]);
    }
}

