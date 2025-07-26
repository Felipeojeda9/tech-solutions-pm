@extends('layouts.app')

@section('title', 'Eliminar Proyecto')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-red-600">Eliminar Proyecto</h2>

    <div id="proyecto-container">
        <p class="text-gray-500">Cargando proyecto...</p>
    </div>

    <div id="confirmacion" style="display: none;" class="mt-6 p-4 bg-red-50 border border-red-200 rounded">
        <p class="text-red-800 font-medium mb-4">
            ⚠️ ¿Estás seguro de que quieres eliminar este proyecto? Esta acción no se puede deshacer.
        </p>

        <div class="flex space-x-3">
            <button id="confirmar-eliminar" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Sí, Eliminar Proyecto
            </button>
            <a href="{{ route('proyectos.show', $id) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </div>

    <div id="mensaje" class="mt-4"></div>
</div>

@push('scripts')
<script>
let proyectoData = null;

document.addEventListener('DOMContentLoaded', function() {
    cargarProyecto();
});

function cargarProyecto() {
    const proyectoId = {{ $id }};

    axios.get(`/proyectos/${proyectoId}`)
        .then(response => {
            proyectoData = response.data;

            const html = `
                <div class="bg-gray-50 p-4 rounded border">
                    <h3 class="text-lg font-semibold mb-3">Datos del Proyecto a Eliminar:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                            <p class="text-lg">${proyectoData.id}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                            <p class="text-lg font-semibold">${proyectoData.nombre}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Inicio</label>
                            <p class="text-lg">${proyectoData.fecha_inicio}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                            <p class="text-lg">
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium ${getEstadoClass(proyectoData.estado)}">
                                    ${proyectoData.estado}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                            <p class="text-lg">${proyectoData.responsable}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Monto</label>
                            <p class="text-lg font-bold text-green-600">$${proyectoData.monto.toLocaleString()}</p>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('proyecto-container').innerHTML = html;
            document.getElementById('confirmacion').style.display = 'block';
        })
        .catch(error => {
            console.error('Error al cargar proyecto:', error);
            document.getElementById('proyecto-container').innerHTML = '<p class="text-red-500">Error al cargar el proyecto.</p>';
        });
}

document.getElementById('confirmar-eliminar').addEventListener('click', function() {
    const proyectoId = {{ $id }};

    axios.delete(`/proyectos/${proyectoId}`)
        .then(response => {
            document.getElementById('mensaje').innerHTML = '<p class="text-green-600">Proyecto eliminado exitosamente.</p>';
            setTimeout(() => {
                window.location.href = '{{ route("proyectos.index") }}';
            }, 1500);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('mensaje').innerHTML = '<p class="text-red-600">Error al eliminar el proyecto.</p>';
        });
});

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