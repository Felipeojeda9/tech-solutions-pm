<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProyectoCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'       => 'required',
            'fecha_inicio' => 'required|date',
            'estado'       => 'required',
            'responsable'  => 'required',
            'monto'        => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors'  => $validator->errors()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $validated = $validator->validated();
            $validated['created_by'] = $request->user()->id;

            $proyecto = Proyecto::create($validated);

            return response()->json([
                'message' => 'Proyecto registrado exitosamente',
                'data'    => $proyecto,
                'status'  => 'success'
            ], JsonResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al registrar el proyecto',
                'error'   => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}