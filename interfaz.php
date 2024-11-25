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
    <link rel="stylesheet" href="CSS/interfaz.css"></head>
    <style> 
    /*estilos directos*/
        footer{   
            background-color: #f1f1f1 ;
            color: #212529;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); /* Sombra superior */
            width: 100%;
        
        }
        .mensaje {
        margin: 10px auto;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        max-width: 400px;
        text-align: center;
        font-weight: bold;
        }

        .mensaje.exito {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
        }

        .mensaje.error {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
        }
    </style>

</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="Imagenes/uadeo_logo.png" alt="UAdeO Logo">
        </div>
      <!---- <div class="menu-icon">
            <div></div>
            <div></div>
            <div></div>
        </div>-- En caso que lleve más apartados--> 
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
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Universidad Autónoma de Occidente | Desarrollado por Servicio Social</p>
    </footer><!-- JavaScript para eliminar el mensaje al recargar -->
    <script>
        window.onload = function() {
            // Eliminar el mensaje del DOM después de 2 segundos
            setTimeout(() => {
                const mensajeDiv = document.getElementById('mensaje');
                if (mensajeDiv) mensajeDiv.remove();
            }, 2000); // aqui se ajusta los segundos que durará el mensaje en la pantalla 
        };
    </script>
</body>
</html>