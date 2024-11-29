<?php
// Reportar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de conexión
$host = "localhost";
$user = "root";
$password = "";
$dbname = "centro_computo";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
