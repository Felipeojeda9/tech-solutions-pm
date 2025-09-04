<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Synfony\Component\HttpFoundation\JsonResponse;

class ProyectoShowController extends Controller
{
    public function __invoke($id)
    {
        return Proyecto::find($id);
        if (!$proyecto) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
                'status' => 'not_found'
            ], JsonResponse::HTTP_NOT_FOUND); //404
        }

        return response()->json([
            'message' => 'Proyecrto obtenido exitosamente',
            'data' => $proyecto, // incluye todos los campos del modelo
            'status' => 'success'
        ], JsonResponse::HTTP_OK); //200
    }
}
