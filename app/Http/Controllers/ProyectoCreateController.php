<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoCreateController extends Controller
{
    public function __invoke(Request $r)
    {
        $data = $r->validate([
            'nombre' =>'required',
            'fecha_inicio' => 'required|date',
            'estado' => 'required',
            'responsable' => 'required',
            'monto' => 'required|numeric',
        ]);
        return Proyecto::create($data);
    }
}
