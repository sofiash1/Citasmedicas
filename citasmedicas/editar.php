<?php
include("conexion.php");

// Validar y obtener ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido");
}

$id = (int)$_GET['id'];

// Procesar formulario si es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos POST
    if (!isset($_POST['paciente']) || !isset($_POST['fecha']) || !isset($_POST['hora']) || !isset($_POST['motivo'])) {
        die("Datos incompletos");
    }

    $paciente = $_POST['paciente'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // Validar que no estén vacíos
    if (empty($paciente) || empty($fecha) || empty($hora) || empty($motivo)) {
        $error = "Todos los campos son obligatorios";
    } else {
        // Usar prepared statement para actualizar
        $sql = "UPDATE citas SET paciente=?, fecha=?, hora=?, motivo=? WHERE id=?";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssi", $paciente, $fecha, $hora, $motivo, $id);

            if ($stmt->execute()) {
                $success = true;
            } else {
                $error = "Error al actualizar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Error en la preparación: " . $conexion->error;
        }
    }
}

// Obtener datos actuales de la cita (solo si no es POST o si hay error)
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($error)) {
    $sql = "SELECT * FROM citas WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        die("Cita no encontrada");
    }

    $fila = $resultado->fetch_assoc();
    $stmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card con formulario -->
                <div class="card shadow">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">Editar Cita Médica</h4>
                    </div>
                    <div class="card-body">
                        <form action="editar.php?id=<?= $id ?>" method="POST" class="row g-3">
                            <!-- Campo oculto para el ID -->
                            <input type="hidden" name="id" value="<?= $id ?>">

                            <div class="col-md-6">
                                <label class="form-label">Paciente:</label>
                                <input type="text" name="paciente" class="form-control"
                                    value="<?= htmlspecialchars($fila['paciente'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha:</label>
                                <input type="date" name="fecha" class="form-control"
                                    value="<?= htmlspecialchars($fila['fecha'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Hora:</label>
                                <input type="time" name="hora" class="form-control"
                                    value="<?= htmlspecialchars($fila['hora'] ?? '') ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Motivo:</label>
                                <textarea name="motivo" class="form-control" rows="3" required><?= htmlspecialchars($fila['motivo'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button class="btn btn-warning" type="submit">Actualizar</button>
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Fin card -->
            </div>
        </div>
    </div>

    <?php if (isset($success) && $success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Cita actualizada',
                text: 'La cita se editó correctamente',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location = 'index.php';
            });
        </script>
    <?php elseif (isset($error)): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= addslashes($error) ?>',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>

</body>

</html>