<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UFController,
    ProyectoCreateController,
    ProyectoIndexController,
    ProyectoShowController,
    ProyectoUpdateController,
    ProyectoDestroyController,
    UserController
};

// Endpoint público
Route::get('/uf', [UFController::class, 'today']);

// Autenticación pública
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

// Rutas protegidas con JWT
Route::middleware(['jwt.auth'])->group(function () {
    // CRUD de proyectos
    Route::post   ('/proyectos', ProyectoCreateController::class);
    Route::get    ('/proyectos', ProyectoIndexController::class);
    Route::get    ('/proyectos/{proyecto}', ProyectoShowController::class);
    Route::match  (['put','patch'], '/proyectos/{proyecto}', ProyectoUpdateController::class);
    Route::delete ('/proyectos/{proyecto}', ProyectoDestroyController::class);

    // Ruta protegida adicional
    Route::get('/perfil', function () {
        return response()->json(['message' => 'Acceso autorizado']);
    });
});