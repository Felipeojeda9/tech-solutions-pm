<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para las vistas del CRUD
Route::get('/proyectos', function () {
    return view('proyectos.index');
})->name('proyectos.index');

Route::get('/proyectos/crear', function () {
    return view('proyectos.create');
})->name('proyectos.create');

Route::get('/proyectos/{id}', function ($id) {
    return view('proyectos.show', ['id' => $id]);
})->name('proyectos.show');

Route::get('/proyectos/{id}/editar', function ($id) {
    return view('proyectos.edit', ['id' => $id]);
})->name('proyectos.edit');

Route::get('/proyectos/{id}/eliminar', function ($id) {
    return view('proyectos.delete', ['id' => $id]);
})->name('proyectos.delete');
