<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProyectoDestroyController extends Controller
{
    public function __invoke($id)
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            return response()->json([
                'message' => 'Proyecto no encontrado',
                'status' => 'not_found'
            ], JsonResponse::HTTP_NOT_FOUND); // 404
        }

        $proyecto->delete();

        return response()->noContent(); // 204
    }
}