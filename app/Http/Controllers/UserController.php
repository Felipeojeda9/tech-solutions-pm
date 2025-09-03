<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

         try {
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
