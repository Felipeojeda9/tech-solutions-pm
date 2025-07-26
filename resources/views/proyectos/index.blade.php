@extends('layouts.app')

@section('title', 'Lista de Proyectos')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Lista de Proyectos</h2>
    
    <div id="proyectos-container">
        <p class="text-gray-500">Cargando proyectos...</p>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    cargarProyectos();
});

function cargarProyectos() {
    axios.get('/proyectos')
        .then(response => {
            const proyectos = response.data;
            let html = '';
            
            if (proyectos.length === 0) {
                html = '<p class="text-gray-500">No hay proyectos disponibles.</p>';
            } else {
                html = `
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">ID</th>
                                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                                <th class="border border-gray-300 px-4 py-2">Fecha Inicio</th>
                                <th class="border border-gray-300 px-4 py-2">Estado</th>
                                <th class="border border-gray-300 px-4 py-2">Responsable</th>
                                <th class="border border-gray-300 px-4 py-2">Monto</th>
                                <th class="border border-gray-300 px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                
                proyectos.forEach(proyecto => {
                    html += `
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">${proyecto.id}</td>
                            <td class="border border-gray-300 px-4 py-2">${proyecto.nombre}</td>
                            <td class="border border-gray-300 px-4 py-2">${proyecto.fecha_inicio}</td>
                            <td class="border border-gray-300 px-4 py-2">${proyecto.estado}</td>
                            <td class="border border-gray-300 px-4 py-2">${proyecto.responsable}</td>
                            <td class="border border-gray-300 px-4 py-2">$${proyecto.monto.toLocaleString()}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="/proyectos/${proyecto.id}" class="bg-blue-500 text-white px-2 py-1 rounded text-sm mr-1">Ver</a>
                                <a href="/proyectos/${proyecto.id}/editar" class="bg-yellow-500 text-white px-2 py-1 rounded text-sm mr-1">Editar</a>
                                <a href="/proyectos/${proyecto.id}/eliminar" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Eliminar</a>
                            </td>
                        </tr>
                    `;
                });
                
                html += '</tbody></table>';
            }
            
            document.getElementById('proyectos-container').innerHTML = html;
        })
        .catch(error => {
            console.error('Error al cargar proyectos:', error);
            document.getElementById('proyectos-container').innerHTML = '<p class="text-red-500">Error al cargar los proyectos.</p>';
        });
}
</script>
@endpush
@endsection
