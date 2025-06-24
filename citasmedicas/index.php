<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio - Citas Médicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="img/cambio.png">
    <style>
        .dark-mode {
            background-color: #1a202c;
            color: #f1f1f1;
        }

       
    </style>
</head>

<body class="bg-gray-100 text-gray-900 transition duration-300">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-pink-700 text-white shadow z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <a href="#" class="flex items-center font-bold text-lg">
                Salud Sena
                <img src="img/logo.png" alt="Logo" class="w-10 ml-1 h-10">
            </a>
            <div class="space-x-4 hidden md:flex">
                <a href="#" class="hover:underline">Inicio</a>
                <a href="#" class="hover:underline">Servicios</a>
                <a href="#" class="hover:underline">Contacto</a>
                <a href="inicio.php" class="px-3 py-1 border border-white rounded hover:bg-white hover:text-pink-700 transition">Ingresar</a>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <section class="pt-24 px-4 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-6 items-center">
            <div>
                <h2 class="text-pink-700 text-3xl font-bold mb-4">Servicios a un clic</h2>
                <p class="text-lg mb-6">Realiza fácilmente tus procesos médicos. ¡Conoce aquí las soluciones virtuales que tenemos para ti!</p>
                <a href="inicio.php" class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 transition">VER TODOS LOS SERVICIOS</a>
            </div>
            <div class="text-center">
                <img src="img/agenda.png" alt="Médico" class="w-48 mx-auto">
            </div>
        </div>
    </section>

    <!-- Tarjetas -->
    <section class="py-12 px-4 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Citas médicas -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center hover:shadow-lg transition dark:bg-gray-800">
                <h5 class="text-xl font-semibold mb-4">Citas médicas</h5>
                <img src="img/calendar.png" alt="Citas" class="w-20 mx-auto mb-4" class="w-20 mx-auto mb-4">
                <a href="inicio.php" class="text-pink-700 font-bold hover:underline">IR →</a>
            </div>
            <!-- Farmadomicilios -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center hover:shadow-lg transition dark:bg-gray-800">
                <h5 class="text-xl font-semibold mb-4">Farmadomicilios</h5>
                <img src="img/farmacia.png" alt="Farmacia" class="w-20 mx-auto mb-4">
                <a href="#" class="text-pink-700 font-bold hover:underline">IR →</a>
            </div>
            <!-- Cambio de IPS -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center hover:shadow-lg transition dark:bg-gray-800">
                <h5 class="text-xl font-semibold mb-4">Cambio de IPS</h5>
                <img src="img/cambio.png" alt="IPS" class="w-20 mx-auto mb-4">
                <a href="#" class="text-pink-700 font-bold hover:underline">IR →</a>
            </div>
        </div>
    </section>

    
</body>

</html>