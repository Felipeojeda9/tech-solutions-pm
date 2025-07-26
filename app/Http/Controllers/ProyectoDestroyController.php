<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoDestroyController extends Controller
{
    public function __invoke($id)
    {
        $deleted = Proyecto::delete($id);
        if ($deleted) {
            return response()->noContent();
        }
        return response()->json(['error' => 'Proyecto no encontrado'], 404);
    }
}

