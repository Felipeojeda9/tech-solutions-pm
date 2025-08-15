<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tech Solutions PM')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3/dist/tailwind.min.css" rel="stylesheet">

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="container mx-auto p-6 bg-gray-50 text-gray-800">

    <!-- Encabezado -->
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Tech Solutions PM</h1>
        <x-uf-widget/>
    </header>

    <!-- Navegación -->
    <nav class="mb-6 flex flex-wrap gap-2">
        <a href="{{ route('proyectos.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lista Proyectos</a>
        <a href="{{ route('proyectos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Crear Proyecto</a>
        <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Login</a>
        <a href="{{ route('register') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Registro</a>
    </nav>

    <!-- Contenido dinámico -->
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('valor-uf.js') }}"></script>
    <script>
        axios.defaults.baseURL = '{{ url("/api") }}';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ✅ Configurar Axios con token JWT si existe
        const token = localStorage.getItem('jwt_token');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        }
    </script>
    @stack('scripts')
</body>
</html>