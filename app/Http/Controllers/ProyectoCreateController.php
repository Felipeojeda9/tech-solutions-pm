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
        $messages = [
            'nombre.required' => 'El nombre del proyecto es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'estado.required' => 'El estado del proyecto es obligatorio.',
            'responsable.required' => 'El responsable del proyecto es obligatorio.',
            'monto.required' => 'El monto del proyecto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un valor numérico.',
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'estado' => 'required',
            'responsable' => 'required',
            'monto' => 'required|numeric',
        ], $messages);


        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
        try {
            $validated = $validator->validated();

            $proyecto = Proyecto::create([
                'nombre' => $validated['nombre'],
                'fecha_inicio' => $validated['fecha_inicio'],
                'estado' => $validated['estado'],
                'responsable' => $validated['responsable'],
                'monto' => $validated['monto'],
            ]);

            return response()->json([
                'message' => 'Proyecto registrado exitosamente',
                'data' => $proyecto,
                'status' => 'success'
            ], JsonResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al registrar el proyecto',
                'error' => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
