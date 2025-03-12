<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Tiempo - Aplicación Meteorológica</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-200 min-h-screen">
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">El Tiempo</a>
            <div class="space-x-4">
                <a href="/tickets" class="hover:text-blue-200">Sistema de Tickets</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="fixed bottom-0 w-full bg-blue-600 text-white p-2 text-center">
        <p class="text-sm">Datos meteorológicos proporcionados por wttr.in</p>
    </footer>
</body>
</html>
