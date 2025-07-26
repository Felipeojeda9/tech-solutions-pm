@extends('layouts.app')
@section('content')
<h2 class="text-xl mb-4">Listado de proyectos</h2>
<table class="min-w-full border">
    <tr class="bg-gray-200"><th>ID</th><th>Nombre</th><th>Estado</th><th>Monto</th></tr>
    @foreach(\App\Models\Proyecto::all() as $p)
        <tr><td>{{ $p['id'] }}</td><td>{{ $p['nombre'] }}</td><td>{{ $p['estado'] }}</td><td>{{ $p['monto'] }}</td></tr>
    @endforeach
</table>
@endsection
