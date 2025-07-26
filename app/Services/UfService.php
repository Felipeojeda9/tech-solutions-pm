<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UfService
{
    public function valorActual(): array 
    {
        $resp = Http::timeout(5)->get('https://mindicador.cl/api/uf');

        if (!$resp->ok()) {
            return ['valor' => null, 'fecha' => null];
        }

        $d = $resp->json();
        return [
            'valor' => $d['serie'][0]['valor'] ?? null,
            'fecha' => $d['serie'][0]['fecha'] ?? null,
        ];
    }
}
