@extends('layouts.app')

@section('title', 'Ver Proyecto')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Detalles del Proyecto</h2>

    <div id="proyecto-container">
        <p class="text-gray-500">Cargando proyecto...</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('proyectos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Volver a la Lista
        </a>
        <a href="{{ route('proyectos.edit', $id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 ml-2">
            Editar Proyecto
        </a>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    cargarProyecto();
});

function cargarProyecto() {
    const proyectoId = {{ $id }};

    axios.get(`/proyectos/${proyectoId}`)
        .then(response => {
            const proyecto = response.data;

            const html = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                        <p class="text-lg">${proyecto.id}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <p class="text-lg font-semibold">${proyecto.nombre}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Inicio</label>
                        <p class="text-lg">${proyecto.fecha_inicio}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <p class="text-lg">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium ${getEstadoClass(proyecto.estado)}">
                                ${proyecto.estado}
                            </span>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                        <p class="text-lg">${proyecto.responsable}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Monto</label>
                        <p class="text-lg font-bold text-green-600">$${proyecto.monto.toLocaleString()}</p>
                    </div>
                </div>
            `;

            document.getElementById('proyecto-container').innerHTML = html;
        })
        .catch(error => {
            console.error('Error al cargar proyecto:', error);
            document.getElementById('proyecto-container').innerHTML = '<p class="text-red-500">Error al cargar el proyecto.</p>';
        });
}

function getEstadoClass(estado) {
    switch(estado) {
        case 'Completo':
            return 'bg-green-100 text-green-800';
        case 'En progreso':
            return 'bg-yellow-100 text-yellow-800';
        case 'Pendiente':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}
</script>
@endpush
@endsection