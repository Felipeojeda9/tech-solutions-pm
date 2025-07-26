<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index() { return Proyecto::all(); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'nombre'       => 'required',
            'fecha_inicio' => 'required|date',
            'estado'       => 'required',
            'responsable'  => 'required',
            'monto'        => 'required|numeric',
        ]);
        return Proyecto::create($data);
    }

    public function show(Proyecto $proyecto)    { return $proyecto; }

    public function update(Request $r, Proyecto $proyecto)
    {
        $proyecto->update($r->all());
        return $proyecto->refresh();
    }
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return response()->noContent();
    }
}
