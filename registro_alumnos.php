<?php
// Iniciar sesión
session_start();

// Reportar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "centro_computo";

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $matricula = $conn->real_escape_string($_POST['matricula']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $primer_apellido = $conn->real_escape_string($_POST['primer-apellido']);
    $segundo_apellido = $conn->real_escape_string($_POST['segundo-apellido']);
    $carrera_id = $conn->real_escape_string($_POST['carrera']);

    // Validar que la matrícula no esté repetida
    $sql_check = "SELECT * FROM alumno WHERE ALU_MATRICULA = '$matricula'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Si ya existe
        $_SESSION['mensaje'] = "Error: La matrícula ya está registrada.";
    } else {
        // Si no existe, insertar el nuevo alumno
        $sql_insert = "INSERT INTO alumno (ALU_MATRICULA, ALU_NOMBRE, ALU_APP, ALU_APM, ALU_CAR_ID) 
                       VALUES ('$matricula', '$nombre', '$primer_apellido', '$segundo_apellido', '$carrera_id')";
        
        if ($conn->query($sql_insert) === TRUE) {
            $_SESSION['mensaje'] = "Alumno registrado con éxito.";
        } else {
            $_SESSION['mensaje'] = "Error al registrar: " . $conn->error;
        }
    }

    // Redirigir para mostrar el mensaje
    header("Location: registro_alumnos.php");
    exit;
}

// Obtener las carreras de la base de datos
$sql_carreras = "SELECT CAR_ID, CAR_NOMBRE FROM carrera";
$result_carreras = $conn->query($sql_carreras);

// Verificar si hay carreras en la base de datos
$carreras = [];
if ($result_carreras->num_rows > 0) {
    while ($row = $result_carreras->fetch_assoc()) {
        $carreras[] = $row; // Guardar las carreras en un arreglo
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
    <link rel="stylesheet" href="CSS/registro.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="Imagenes/uadeo_logo.png" alt="UAdeO Logo">
        </div>
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
        <section class="form-section">
            <h1>Registro de Alumnos</h1>
            
            <!-- Mostrar mensaje si existe -->
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="mensaje">
                    <?= htmlspecialchars($_SESSION['mensaje']); ?>
                </div>
                <?php unset($_SESSION['mensaje']); ?>
            <?php endif; ?>
            
            <div class="form-container">
                <form action="registro_alumnos.php" method="post">
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
                        <!-- Generar dinámicamente las opciones -->
                        <?php foreach ($carreras as $carrera): ?>
                            <option value="<?= $carrera['CAR_ID']; ?>"><?= htmlspecialchars($carrera['CAR_NOMBRE']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <button type="submit" class="btn">Registrarse</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Universidad Autónoma de Occidente | Desarrollado por Servicio Social</p>
    </footer>
</body>
</html>
