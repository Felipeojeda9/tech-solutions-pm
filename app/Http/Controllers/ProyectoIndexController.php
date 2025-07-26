<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;      //importar el modelo

class ProyectoIndexController extends Controller
{
    public function __invoke()
    {

        return Proyecto::all(); //para devoler el json con todos los proyectos
    }
}

