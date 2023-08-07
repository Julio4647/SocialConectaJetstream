<!DOCTYPE html>
<html>
<head>
    <title>Acceso Denegado</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 shadow-md rounded-md">
        <h1 class="text-2xl font-semibold mb-4">Acceso Denegado</h1>
        <p class="mb-4">No tienes permiso para acceder a esta página.</p>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="goBack()">Regresar</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
