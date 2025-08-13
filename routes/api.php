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

/* ---endpoints crud---*/
Route::post   ('/proyectos', ProyectoCreateController::class);
Route::get    ('/proyectos', ProyectoIndexController::class);
Route::get    ('/proyectos/{proyecto}', ProyectoShowController::class);
Route::put    ('/proyectos/{proyecto}', ProyectoUpdateController::class);
Route::delete ('/proyectos/{proyecto}', ProyectoDestroyController::class);
Route::get('/uf', [UFController::class, 'today']);

Route::post('/registro', [UserController::class, 'register']);
Route::post('/ingreso', [UserController::class, 'login']);



