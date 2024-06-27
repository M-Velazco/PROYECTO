<?php

header("Content-Type: application/json"); // Establecer el encabezado JSON

include_once '../modelo/conexion.php';

// Función para manejar las respuestas de error
function sendError($message) {
    http_response_code(500); // Establecer código de respuesta HTTP 500 (Error del servidor)
    echo json_encode(array("error" => $message));
    exit();
}

// Crear conexión con la base de datos
$Conexion = Conectarse(); // Suponiendo que la función Conectarse() está definida en el archivo '../modelo/conexion.php'

// Verificar la conexión
if ($Conexion->connect_error) {
    sendError("Conexión fallida: " . $Conexion->connect_error);
}

// Verificar el método de la solicitud
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    sendError("Método no permitido. Solo se permite el método GET.");
}

// Realizar la consulta a la base de datos
$consulta = $Conexion->query("SELECT Opinion, Nombres_Apellidos FROM opiniones");

// Verificar si se encontraron resultados
if ($consulta) {
    // Verificar si se encontraron opiniones
    if ($consulta->num_rows > 0) {
        // Array para almacenar las opiniones
        $opiniones = array();

        // Iterar sobre los resultados y almacenarlos en el array
        while ($row = $consulta->fetch_assoc()) {
            $opiniones[] = $row;
        }

        // Devolver las opiniones en formato JSON
        echo json_encode($opiniones);
    } else {
        sendError("No se encontraron opiniones.");
    }
} else {
    sendError("Error al ejecutar la consulta.");
}

// Cerrar la conexión con la base de datos
$Conexion->close();

?>
