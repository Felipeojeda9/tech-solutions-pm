<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProyectoCreateController,
    ProyectoIndexController,
    ProyectoShowController,
    ProyectoUpdateController,
    ProyectoDestroyController
};

/* ---endpoints crud---*/
Route::post   ('/proyectos', ProyectoCreateController::class);
Route::get    ('/proyectos', ProyectoIndexController::class);
Route::get    ('/proyectos/{proyecto}', ProyectoShowController::class);
Route::put    ('/proyectos/{proyecto}', ProyectoUpdateController::class);
Route::delete ('/proyectos/{proyecto}', ProyectoDestroyController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

