<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tech Solutions PM')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="container mx-auto p-6">
    <header class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Gestión de Proyectos</h1>
        <x-uf-widget/>
    </header>
    
    <nav class="mb-6">
        <a href="{{ route('proyectos.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Lista Proyectos</a>
        <a href="{{ route('proyectos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Crear Proyecto</a>
    </nav>

    @yield('content')

    <script src="{{ asset('valor-uf.js') }}"></script>
    <script>
        axios.defaults.baseURL = '{{ url("/api") }}';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>
    @stack('scripts')
</body>
</html>