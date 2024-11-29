<?php
// Iniciar sesión
session_start();

// Incluir el archivo de conexión
require 'conexion.php';
// Configuración para la paginación
$registros_por_pagina = 50; // Número de registros por página
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página actual
if ($pagina_actual < 1) $pagina_actual = 1; // Asegurar que la página no sea negativa o cero
$offset = ($pagina_actual - 1) * $registros_por_pagina;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = $conn->real_escape_string($_POST['matricula']);

    // Consulta para verificar que existe la matrícula en la tabla "alumnos"
    $sql = "SELECT A.ALU_MATRICULA, A.ALU_CAR_ID, A.ALU_NOMBRE, A.ALU_APP, A.ALU_APM, C.CAR_NOMBRE 
        FROM alumno A 
        INNER JOIN carrera C ON A.ALU_CAR_ID = C.CAR_ID 
        WHERE A.ALU_MATRICULA = '$matricula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Datos encontrados
        $row = $result->fetch_assoc();
        $carrera_id = $row['ALU_CAR_ID'];
        $nombre_alumno = $row['ALU_NOMBRE'];
        $app_alumno = $row['ALU_APP'];
        $apm_alumno = $row['ALU_APM'];
        $nombre_carrera = $row['CAR_NOMBRE'];

        // Insertar datos en la tabla de "registros"
        $sql_insert = "INSERT INTO registro (REG_ALU_MATRICULA, REG_CAR_ID) 
                       VALUES ('$matricula', $carrera_id)";
        if ($conn->query($sql_insert) === TRUE) {
            // Guardar mensaje en la sesión
            $_SESSION['mensaje'] = "Registro exitoso para $nombre_alumno $app_alumno $apm_alumno de la carrera $nombre_carrera.";
        } else {
            $_SESSION['mensaje'] = "Error al registrar: " . $conn->error;
        }
    } else {
        // Mensaje de advertencia que no se encontró el alumno
        $_SESSION['mensaje'] = "Matrícula no encontrada. Verifica tus datos.";
    }

    // Redirigir a la interfaz/index
    header("Location: index.php");
    exit;
}

// Consultar los registros con paginación
$sql_registros = "SELECT R.REG_ALU_MATRICULA, A.ALU_NOMBRE, A.ALU_APP, A.ALU_APM, C.CAR_NOMBRE, R.REG_FECHA
                  FROM registro R
                  INNER JOIN alumno A ON R.REG_ALU_MATRICULA = A.ALU_MATRICULA
                  INNER JOIN carrera C ON R.REG_CAR_ID = C.CAR_ID
                  ORDER BY R.REG_FECHA DESC
                  LIMIT $registros_por_pagina OFFSET $offset";
$result_registros = $conn->query($sql_registros);

// Calcular el número total de páginas
$sql_total_registros = "SELECT COUNT(*) AS total FROM registro";
$result_total = $conn->query($sql_total_registros);
$total_registros = $result_total->fetch_assoc()['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Cerrar conexión
$conn->close();
?>
