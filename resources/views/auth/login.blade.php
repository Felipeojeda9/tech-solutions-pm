@extends('layouts.app')

@section('title', 'Inicio de Sesión')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Inicio de Sesión</h2>

    <form id="login-form">
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" id="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" id="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Iniciar Sesión
            </button>
        </div>
    </form>

    <div id="mensaje" class="mt-4"></div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = {
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    axios.post('/api/login', formData)
        .then(response => {
            // Guardar token JWT
            localStorage.setItem('jwt_token', response.data.token);

            // Configurar Axios para futuras peticiones
            axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

            document.getElementById('mensaje').innerHTML = '<p class="text-green-600">Inicio de sesión exitoso.</p>';
            document.getElementById('login-form').reset();

            // Redirigir si lo deseas
            // window.location.href = '/proyectos';
        })
        .catch(error => {
            console.error(error);
            document.getElementById('mensaje').innerHTML = '<p class="text-red-600">Credenciales inválidas.</p>';
        });
});
</script>
@endpush