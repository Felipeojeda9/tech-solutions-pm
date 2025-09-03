<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProyectoIndexController extends Controller
{
    public function __invoke()
    {

        $proyectos = Proyecto::orderBy('id', 'desc')->get();

        if ($proyectos->isEmpty()) {
            return response()->Json([
                'message' => 'No se encontraron proyectos',
                'data' => [],
                'status' => 'success'
            ], JsonResponse::HTTP_OK);
        }

        return response()->Json([
            'message' => 'Lista de proyectos obtenida exitosamente',
            'data' => $proyectos,
            'status' => 'success'
        ], JsonResponse::HTTP_OK);
    }
}
