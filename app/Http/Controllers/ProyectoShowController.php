<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProyectoShowController extends Controller
{
    public function __invoke($id)
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
                'status'  => 'not_found'
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json([
            'message' => 'Proyecto obtenido exitosamente',
            'data'    => $proyecto,
            'status'  => 'success'
        ], JsonResponse::HTTP_OK);
    }
}