<?php

// Establecer encabezado para indicar que el contenido es JSON
header('Content-Type: application/json');

// Incluir archivo de conexión a la base de datos
include_once '../modelo/conexion.php';

// Función para manejar errores y enviar respuestas JSON
function sendResponse($status, $message, $data = null) {
    http_response_code($status);
    echo json_encode(array('status' => $status, 'message' => $message, 'data' => $data));
    exit();
}

// Crear conexión con la base de datos
$conexion = Conectarse(); // Suponiendo que la función Conectarse() está definida en el archivo '../modelo/conexion.php'

// Verificar la conexión
if ($conexion->connect_error) {
    sendResponse(500, "Conexión fallida: " . $conexion->connect_error);
}

// Realizar la consulta a la base de datos
$consulta = $conexion->query("SELECT docente.Curso, docente.Nombres, docente.Apellidos, curso.Nombre_curso AS Nombre_curso
FROM docente 
INNER JOIN curso ON docente.Curso = curso.idCurso");

// Verificar si se encontraron resultados
if ($consulta) {
    // Verificar si se encontraron cursos
    if ($consulta->num_rows > 0) {
        // Array para almacenar los datos de los cursos y sus docentes
        $cursos = array();

        // Iterar sobre los resultados y almacenarlos en el array
        while ($row = $consulta->fetch_assoc()) {
            $cursos[] = $row;
        }

        // Devolver los datos de los cursos en formato JSON
        sendResponse(200, "Éxito", $cursos);
    } else {
        sendResponse(404, "No se encontraron cursos.");
    }
} else {
    sendResponse(500, "Error al ejecutar la consulta: " . $conexion->error);
}

// Cerrar la conexión con la base de datos
$conexion->close();

?>
