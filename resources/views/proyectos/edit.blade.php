@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Editar Proyecto</h2>
    
    <div id="loading" class="text-gray-500 mb-4">Cargando datos del proyecto...</div>
    
    <form id="editar-proyecto-form" style="display: none;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select id="estado" name="estado" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En progreso">En progreso</option>
                    <option value="Completo">Completo</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Responsable</label>
                <input type="text" id="responsable" name="responsable" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Monto</label>
                <input type="number" id="monto" name="monto" step="0.01" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Actualizar Proyecto
            </button>
            <a href="{{ route('proyectos.show', $id) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>
    
    <div id="mensaje" class="mt-4"></div>
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
            
            // Llenar el formulario con los datos del proyecto
            document.getElementById('nombre').value = proyecto.nombre;
            document.getElementById('fecha_inicio').value = proyecto.fecha_inicio;
            document.getElementById('estado').value = proyecto.estado;
            document.getElementById('responsable').value = proyecto.responsable;
            document.getElementById('monto').value = proyecto.monto;
            
            // Mostrar el formulario y ocultar loading
            document.getElementById('loading').style.display = 'none';
            document.getElementById('editar-proyecto-form').style.display = 'block';
        })
        .catch(error => {
            console.error('Error al cargar proyecto:', error);
            document.getElementById('loading').innerHTML = '<p class="text-red-500">Error al cargar el proyecto.</p>';
        });
}

document.getElementById('editar-proyecto-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const proyectoId = {{ $id }};
    const formData = {
        nombre: document.getElementById('nombre').value,
        fecha_inicio: document.getElementById('fecha_inicio').value,
        estado: document.getElementById('estado').value,
        responsable: document.getElementById('responsable').value,
        monto: parseFloat(document.getElementById('monto').value)
    };
    
    axios.put(`/proyectos/${proyectoId}`, formData)
        .then(response => {
            document.getElementById('mensaje').innerHTML = '<p class="text-green-600">Proyecto actualizado exitosamente.</p>';
            setTimeout(() => {
                window.location.href = '{{ route("proyectos.show", $id) }}';
            }, 1500);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('mensaje').innerHTML = '<p class="text-red-600">Error al actualizar el proyecto.</p>';
        });
});
</script>
@endpush
@endsection