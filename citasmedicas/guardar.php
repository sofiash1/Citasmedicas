<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("conexion.php");

// Validar que los datos existan
if (!isset($_POST['paciente']) || !isset($_POST['fecha']) || !isset($_POST['hora']) || !isset($_POST['motivo'])) {
    die("Datos incompletos");
}

$paciente = $_POST['paciente'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$motivo = $_POST['motivo'];

// Validar que no estén vacíos
if (empty($paciente) || empty($fecha) || empty($hora) || empty($motivo)) {
    die("Todos los campos son obligatorios");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando...</title>
    <!-- Cargar SweetAlert2 ANTES de usarlo -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php
    // Usar prepared statements para evitar SQL injection
    $sql = "INSERT INTO citas (paciente, fecha, hora, motivo) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $paciente, $fecha, $hora, $motivo);

        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Registrado!',
                text: 'La cita fue registrada con éxito'
            }).then(() => {
                window.location = 'index.php';
            });
        </script>";
        } else {
            // Escapar el mensaje de error para evitar problemas con comillas
            $error = addslashes($stmt->error);
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo registrar: $error'
            }).then(() => {
                window.location = 'index.php';
            });
        </script>";
        }
        $stmt->close();
    } else {
        $error = addslashes($conexion->error);
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'Error en la preparación: $error'
        }).then(() => {
            window.location = 'index.php';
        });
    </script>";
    }

    $conexion->close();
    ?>

</body>

</html>