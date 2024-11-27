<?php
// Iniciar sesión
session_start();

// Guardar el mensaje temporal en una variable y eliminarlo de la sesión
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
unset($_SESSION['mensaje']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <link rel="stylesheet" href="CSS/index.css"></head>
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
        <i class="fas fa-bars"></i> <!-- Asegúrate de usar Font Awesome para este ícono -->
    </label>
    <ul class="dropdown-menu">
        <li><a href="index.php">Ingreso</a></li>
        <li><a href="registro_alumnos.php">Registro</a></li>
    </ul>
    </header>

    <main>
        <br>
        <h1>Registro de Alumnos</h1>
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
        <!-- Aqui se van ir agregando dinamicamente las filas -->
      </tbody>
    </table>
  </main>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer class="footer">
        <p>&copy; 2024 Universidad Autónoma de Occidente | Desarrollado por Servicio Social</p>
    </footer><!-- JavaScript para eliminar el mensaje al recargar -->
    <script>
        window.onload = function() {
            // Eliminar el mensaje después de 2 segundos
            setTimeout(() => {
                const mensajeDiv = document.getElementById('mensaje');
                if (mensajeDiv) mensajeDiv.remove();
            }, 2000); // aqui se ajusta los segundos que durará el mensaje en la pantalla 
        };
    </script>
</body>
</html>