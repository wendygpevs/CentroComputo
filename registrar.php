<?php
// Iniciar sesión
session_start();

// Reportar errores en caso que los tenga
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "centro_computo"; // Conexión directamente a la base de datos

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = $conn->real_escape_string($_POST['matricula']);

    // Consulta para verificar que existe la matrícula en la tabla "alumnos"
    $sql = "SELECT a.matricula, a.carrera_id, a.nombre AS nombre_alumno, c.nombre_carrera 
            FROM alumnos a 
            INNER JOIN carreras c ON a.carrera_id = c.id 
            WHERE a.matricula = '$matricula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Datos encontrados
        $row = $result->fetch_assoc();
        $carrera_id = $row['carrera_id'];
        $nombre_alumno = $row['nombre_alumno'];
        $nombre_carrera = $row['nombre_carrera'];

        // Insertar datos en la tabla de "registros"
        $sql_insert = "INSERT INTO registros (matricula, carrera_id, nombre_alumno, nombre_carrera) 
                       VALUES ('$matricula', $carrera_id, '$nombre_alumno', '$nombre_carrera')";
        if ($conn->query($sql_insert) === TRUE) {
            // Guardar mensaje en la sesión
            $_SESSION['mensaje'] = "Registro exitoso para $nombre_alumno en la carrera $nombre_carrera.";
        } else {
            $_SESSION['mensaje'] = "Error al registrar: " . $conn->error;
        }
    } else {
        // Mensaje de advertencia que no se encontró el alumno
        $_SESSION['mensaje'] = "Matrícula no encontrada. Verifica tus datos.";
    }

    // Redirigir a la interfaz
    header("Location: interfaz.php");
    exit;
}

$conn->close();
?>
