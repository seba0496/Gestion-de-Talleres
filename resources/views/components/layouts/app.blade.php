<!DOCTYPE html>
<html lang="es" data-theme="default">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('titulo', 'Gestor de talleres')</title>
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    </head>
    <body class="bg-gray-100">
      <div class="flex">
        <aside class="fixed top-0 left-0 h-full w-64 z-20">
          @livewire('sidebar')
        </aside>
        <div class="flex-1 ml-64 min-h-screen flex flex-col">
          <main class="flex-grow p-4">
            @yield('contenido')
          </main>
          <footer class="bg-gray-800 text-white p-4 mt-4">
              <p class="text-center">&copy; {{ date('Y') }} Gestor de talleres</p>
          </footer>
        </div>
      </div>
      @livewireScripts
    </body>
</html>
