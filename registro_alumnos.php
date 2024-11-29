<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <link rel="stylesheet" href="CSS/registro.css"></head>
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
    <section class="form-section">
            <h1>Registro de Alumnos</h1>
            <div class="form-container">
                <form action="#" method="post">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" id="matricula" name="matricula" placeholder="Ingresa tu matrícula" required>
                    
                    <label for="nombre">Nombre(s):</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre(s)" required>
                    
                    <label for="primer-apellido">Primer Apellido:</label>
                    <input type="text" id="primer-apellido" name="primer-apellido" placeholder="Ingresa tu primer apellido" required>
                    
                    <label for="segundo-apellido">Segundo Apellido:</label>
                    <input type="text" id="segundo-apellido" name="segundo-apellido" placeholder="Ingresa tu segundo apellido">
                    
                    <label for="carrera">Carrera:</label>
                    <select id="carrera" name="carrera" required>
                        <option value="" disabled selected>Selecciona la carrera</option>
                        <option value="ingenieria">Ingeniería</option>
                        <option value="medicina">Medicina</option>
                        <option value="derecho">Derecho</option>
                    </select>
                    
                    <button type="submit" class="btn">Registrarse</button>
                </form>
            </div>
        </section>
    </main>

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer class="footer">
        <p>&copy; 2024 Universidad Autónoma de Occidente | Desarrollado por Servicio Social</p>
    </footer><!-- JavaScript para eliminar el mensaje al recargar -->
</body>
</html>
