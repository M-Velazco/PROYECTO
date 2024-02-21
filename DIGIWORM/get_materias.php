<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "digiworm_04");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener las materias
$sql = "SELECT idMateria, Nombre_Materia FROM materias"; // Corregido el nombre del campo a idMateria
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Arreglo para almacenar las materias
    $materias = array();

    // Obtener los datos de las materias
    while ($fila = $resultado->fetch_assoc()) {
        $materias[] = $fila;
    }

    // Devolver las materias en formato JSON
    echo json_encode($materias);
} else {
    echo "No se encontraron materias";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
