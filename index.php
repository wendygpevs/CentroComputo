<?php
// Iniciar sesión
session_start();

// Guardar el mensaje temporal en una variable y eliminarlo de la sesión
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
unset($_SESSION['mensaje']);

require 'conexion.php';


// Consulta para obtener todos los registros
$sql = "SELECT R.REG_ALU_MATRICULA, A.ALU_NOMBRE, A.ALU_APP, A.ALU_APM, C.CAR_NOMBRE, R.REG_FECHA
        FROM registro R
        INNER JOIN alumno A ON R.REG_ALU_MATRICULA = A.ALU_MATRICULA
        INNER JOIN carrera C ON R.REG_CAR_ID = C.CAR_ID
        ORDER BY R.REG_FECHA DESC"; // Los registros más recientes aparecen primero
$result = $conn->query($sql);

$registros = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $registros[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <link rel="stylesheet" href="CSS/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="Imagenes/uadeo_logo.png" alt="UAdeO Logo">
        </div>
        <!-- Menú desplegable -->
    <input type="checkbox" id="click" class="menu-checkbox">
    <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
    </label>
    <ul class="dropdown-menu">
        <li><a href="index.php">Ingreso</a></li>
        <li><a href="registro_alumnos.php">Registro</a></li>
    </ul>
    </header>

    <main>
        <br>
        <h1>Ingreso de Alumnos</h1>
        <br>
        <!-- Mostrar mensaje si está presente -->
        <?php if ($mensaje): ?>
            <div id="mensaje" class="mensaje <?= strpos($mensaje, 'exitoso') !== false ? 'exito' : 'error'; ?>">
                <?= htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form action="registrar.php" method="POST">
            <label for="matricula">Ingrese su Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>
            <br><br><br>
            <button type="submit" class="btn">Registrar ➡</button>
            <br><br><br><br>
        </form>
        <p>¿Tu matrícula no está registrada? <a href="registro_alumnos.php">Regístrate aquí</a></p>
        <br>
        <table class="alumnos-tabla">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Alumno</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Carrera</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?= htmlspecialchars($registro['REG_ALU_MATRICULA']); ?></td>
                        <td><?= htmlspecialchars($registro['ALU_NOMBRE']); ?></td>
                        <td><?= htmlspecialchars($registro['ALU_APP']); ?></td>
                        <td><?= htmlspecialchars($registro['ALU_APM']); ?></td>
                        <td><?= htmlspecialchars($registro['CAR_NOMBRE']); ?></td>
                        <td><?= date('Y-m-d H:i:s', strtotime($registro['REG_FECHA'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer class="footer">
        <p>&copy; 2024 Universidad Autónoma de Occidente | Desarrollado por Servicio Social</p>
    </footer>

    <script>
        window.onload = function() {
            // Eliminar el mensaje después de 2 segundos
            setTimeout(() => {
                const mensajeDiv = document.getElementById('mensaje');
                if (mensajeDiv) mensajeDiv.remove();
            }, 4000); // Ajusta el tiempo en que durará el mensaje en la pantalla
        };
    </script>
</body>
</html>
