<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Usuario: {{ $usuario->nombre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white shadow-md rounded-lg p-6 max-w-lg w-full">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Detalles del Usuario</h1>

        <div class="mb-4">
            <p class="text-gray-700 text-lg mb-2"><strong>ID:</strong> {{ $usuario->id }}</p>
            <p class="text-gray-700 text-lg mb-2"><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
            <p class="text-gray-700 text-lg mb-2"><strong>Email:</strong> {{ $usuario->email }}</p>
            <p class="text-gray-700 text-lg mb-2"><strong>Rol:</strong> {{ $usuario->rol }}</p>

        </div>

        <div class="mt-6 text-center">
            {{-- Botón para volver a la lista de usuarios --}}
            <a href="{{ route('users.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Volver a la Lista de Usuarios
            </a>
            {{-- Botón para editar este usuario --}}
            {{-- Añadimos la misma lógica de "si tiene ID" por si acaso, aunque en 'show' no debería ser necesario --}}
            @if($usuario->id)
                <a href="{{ route('users.edit', $usuario->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-200 ml-4">
                    Editar Usuario
                </a>
            @else
                <span class="text-gray-500 ml-4">No se puede editar (ID faltante)</span>
            @endif
        </div>
    </div>

</body>
</html>
