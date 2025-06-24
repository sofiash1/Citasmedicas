<?php include("conexion.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Citas Médicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="estilos.css">
   
</head>

<body class="min-h-screen bg-pink-100 text-gray-900 transition duration-300 px-4 py-6">

    <div class="max-w-6xl mx-auto">
        <h2 class="text-center text-3xl font-bold text-pink-700 mb-8">Gestión de Citas Médicas</h2>

        <!-- FORMULARIO -->
        <form action="guardar.php" method="POST" class="fondo grid md:grid-cols-2 gap-4 bg-pink-800 p-6 rounded-lg shadow dark:bg-gray-800">
            <div>
                <label class="text-white block font-semibold mb-1" for="paciente">Paciente:</label>
                <input type="text" name="paciente" required class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>
            <div>
                <label class="text-white block font-semibold mb-1" for="fecha">Fecha:</label>
                <input type="date" name="fecha" required class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="text-white block font-semibold mb-1" for="hora">Hora:</label>
                <input type="time" name="hora" required class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="md:col-span-2">
                <label class="text-white block font-semibold mb-1" for="motivo">Motivo:</label>
                <textarea name="motivo" rows="3" class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="md:col-span-2 text-center mt-4">
                <button type="submit" class="registrar bg-pink-100 text-pink-700 px-6 py-2 rounded hover:bg-pink-500 hover:text-white transition">Registrar Cita</button>
            </div>
        </form>

        <!-- TABLA -->
        <div class="overflow-x-auto mt-10 bg-white rounded shadow dark:bg-gray-800">
            <table class="min-w-full text-sm ">
                <thead class="bg-pink-200 text-pink-800 dark:bg-gray-700 dark:text-white">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Paciente</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Hora</th>
                        <th class="px-4 py-2">Motivo</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <?php
                    $resultado = $conexion->query("SELECT * FROM citas");
                    while ($fila = $resultado->fetch_assoc()):
                    ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2"><?= $fila['id'] ?></td>
                            <td class="px-4 py-2"><?= $fila['paciente'] ?></td>
                            <td class="px-4 py-2"><?= $fila['fecha'] ?></td>
                            <td class="px-4 py-2"><?= $fila['hora'] ?></td>
                            <td class="px-4 py-2"><?= $fila['motivo'] ?></td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="editar.php?id=<?= $fila['id'] ?>" class="editar bg-pink-200 text-pink-500 px-3 py-1 rounded hover:bg-pink-600 hover:text-white transition text-sm">Editar</a>
                                <button onclick="confirmarEliminacion(<?= $fila['id'] ?>)" class="eliminar bg-pink-800 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">Eliminar</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botón modo oscuro -->
    <button onclick="toggleDarkMode()" class="btn fixed bottom-6 right-6 p-3 rounded-full hover:bg-pink-700 transition" title="Modo oscuro">
        🌙
    </button>

    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'eliminar.php?id=' + id;
                }
            })
        }

        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("modoOscuro", document.body.classList.contains("dark-mode"));
        }

        window.onload = function() {
            if (localStorage.getItem("modoOscuro") === "true") {
                document.body.classList.add("dark-mode");
            }
        }
    </script>
</body>

</html>