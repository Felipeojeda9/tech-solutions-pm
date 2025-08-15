<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UFController;
use App\Http\Controllers\{
    ProyectoCreateController,
    ProyectoIndexController,
    ProyectoShowController,
    ProyectoUpdateController,
    ProyectoDestroyController,
    UserController
};


Route::get('/uf', [UFController::class, 'today']);

/* Endpoints públicos de autenticación */
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

/* Rutas protegidas con JWT */
Route::middleware(['jwt.auth'])->group(function () {
    // CRUD de proyectos
    Route::post   ('/proyectos', ProyectoCreateController::class);
    Route::get    ('/proyectos', ProyectoIndexController::class);
    Route::get    ('/proyectos/{proyecto}', ProyectoShowController::class);
    Route::put    ('/proyectos/{proyecto}', ProyectoUpdateController::class);
    Route::delete ('/proyectos/{proyecto}', ProyectoDestroyController::class);

    // Ejemplo de ruta protegida adicional
    Route::get('/perfil', function () {
        return response()->json(['message' => 'Acceso autorizado']);
    });
});