<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'Por favor ingresa tu nombre.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'name.max' => 'El nombre no debe exceder los 50 caracteres.',
            'email.max' => 'El correo no debe exceder los 50 caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $validated = $validator->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            return response()->json([
                'message' => 'Usuario registrado exitosamente',
                'data' => $user,
                'status' => 'success'
            ], JsonResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al registrar el usuario',
                'error' => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        return response()->json([
            'message' => 'Ingreso exitoso',
            'token' => $token,
        ]);
    }
}
