<?php

// Establecer encabezado para indicar que el contenido es JSON
header('Content-Type: application/json');

// Incluir archivos necesarios
include_once '../modelo/conexion.php';
include_once '../modelo/USUARIO.php';

// Función para manejar errores
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
$consulta = $conexion->query("SELECT usuarios.Nombres, usuarios.Apellidos, usuarios.img, docente.Materia, materias.Nombre_Materia AS nombre_materia
FROM usuarios 
INNER JOIN docente ON usuarios.Idusuarios = docente.idDocente
INNER JOIN materias ON docente.Materia = materias.idMaterias");

// Verificar si se encontraron resultados
if ($consulta) {
    // Verificar si se encontraron docentes con materias asignadas
    if ($consulta->num_rows > 0) {
        // Array para almacenar los datos de los docentes y sus materias
        $docentes = array();

        // Iterar sobre los resultados y almacenarlos en el array
        while ($row = $consulta->fetch_assoc()) {
            $docentes[] = $row;
        }

        // Devolver los datos de los docentes y sus materias en formato JSON
        sendResponse(200, "Éxito", $docentes);
    } else {
        sendResponse(404, "No se encontraron docentes con materias asignadas.");
    }
} else {
    sendResponse(500, "Error al ejecutar la consulta.");
}

// Cerrar la conexión con la base de datos
$conexion->close();

?>
