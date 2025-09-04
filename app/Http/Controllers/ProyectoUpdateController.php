<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProyectoUpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto) {
            return response()_>json([
                'message' => 'proyecto no encontrado',
                'status' => 'not_found'
            ], JsonResponse::HTTP_NOT_FOUND); //404 
        }

        //Reglas para PATCH 
        $rules = [
            'nombre' =[ 
                'nombre' => 'sometimes|required|string|max:255',
                'fecha_inicio' => 'sometimes|required|date',
                'estado' => 'sometimes|required|string|max:100',
                'responsable' => 'sometimes|required|string|max:255',
                'monto' => 'sometimes|required|numeric|min:0',
                'created_by' => 'sometimes|required|integer|exists:user,id',

            ];

            // si el metodo es put, todos requeridos
            if ($request->isMethod('put')) {
                $rules = [
                    'nombre' => 'required|string|max:255',
                    'fecha_inicio' => 'required|date',
                    'estado' => 'required|string|max:100',
                    'responsable' => 'required|string|max:255',
                    'monto' => 'required|numeric|min:0',
                    'create_by' => 'required|integer|exists:users,id',
                ];
            }
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json8[
                    'message' 0> 'Errores en validacion',
                    'errors' 0> $validator->errors(),
                    'status' => 'validation_error'
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY); //422
            }
            try {
                $proyecto->fill($validator->validated());
                $proyecto->save();

                return response()->json([
                    'message' => 'proyecto actualizado correctamente',
                    'data' => $proyecto,
                    'status' => 'success'
        ], JsonResponse::HTTP_OK); //200
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'Error al actualizar el proyecto',
                    'error' => $th-getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR); //500
            }
        }
    }


