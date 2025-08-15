@extends('layouts.app')

@section('title', 'Registro de Usuario')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Registro de Usuario</h2>

    <form id="registro-form">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" id="name" name="name" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" id="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" id="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Registrarse
            </button>
        </div>
    </form>

    <div id="mensaje" class="mt-4"></div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('registro-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    axios.post('/api/register', formData)
        .then(response => {
            // Guardar token JWT
            localStorage.setItem('jwt_token', response.data.token);

            // Configurar Axios para futuras peticiones
            axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

            document.getElementById('mensaje').innerHTML = '<p class="text-green-600">Registro exitoso.</p>';
            document.getElementById('registro-form').reset();

            // Redirigir si lo deseas
            // window.location.href = '/proyectos';
        })
        .catch(error => {
            console.error(error);
            document.getElementById('mensaje').innerHTML = '<p class="text-red-600">Error al registrar usuario.</p>';
        });
});
</script>
@endpush