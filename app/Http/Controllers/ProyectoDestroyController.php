<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectoDestroyController extends Controller
{
    public function __invoke(Proyecto $proyecto)
    {
        $proyecto->delete();
        return response()->noContent();
    }
}

