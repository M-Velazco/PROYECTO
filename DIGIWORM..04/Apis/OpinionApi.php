<?php

include_once '../modelo/conexion.php';

// Crear conexión con la base de datos
$Conexion = Conectarse(); // Suponiendo que la función Conectarse() está definida en el archivo '../modelo/conexion.php'

// Verificar la conexión
if ($Conexion->connect_error) {
    die("Conexión fallida: " . $Conexion->connect_error);
}

// Realizar la consulta a la base de datos
$consulta = $Conexion->query("SELECT Opinion, Nombres_Apellidos FROM opiniones");

// Verificar si se encontraron resultados
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
    echo "No se encontraron opiniones.";
}

// Cerrar la conexión con la base de datos
$Conexion->close();

?>
