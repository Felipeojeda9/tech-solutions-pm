<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        return Proyecto::paginate(10);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'nombre'       => 'required',
            'fecha_inicio' => 'required|date',
            'estado'       => 'required',
            'responsable'  => 'required',
            'monto'        => 'required|numeric',
        ]);
        $data['created_by'] = $r->user()->id;
        return Proyecto::create($data);
    }

    public function show(Proyecto $proyecto)
    {
        return $proyecto;
    }

    public function update(Request $r, Proyecto $proyecto)
    {
        $data = $r->validate([
            'nombre'       => 'sometimes|required',
            'fecha_inicio' => 'sometimes|required|date',
            'estado'       => 'sometimes|required',
            'responsable'  => 'sometimes|required',
            'monto'        => 'sometimes|required|numeric',
        ]);
        $proyecto->update($data);
        return $proyecto->refresh();
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return response()->noContent();
    }
}