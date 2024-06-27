<?php
// Conexión a la base de datos
require_once "../modelo/conexion.php";

// Consulta para obtener las materias desde la base de datos
$conn = Conectarse(); // Supongo que esta función realiza la conexión a la base de datos, ajústala según tu implementación

$sql = "SELECT idMateria, nombreMateria FROM materia";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear un array para almacenar las materias
    $materias = array();
    while ($row = $result->fetch_assoc()) {
        // Agregar cada materia al array
        $materia = array(
            'idMateria' => $row['idMateria'],
            'nombreMateria' => $row['nombreMateria']
        );
        array_push($materias, $materia);
    }
    // Convertir el array de materias a formato JSON y devolverlo
    echo json_encode($materias);
} else {
    // Si no hay materias, devolver un mensaje de error
    echo json_encode(array('error' => 'No se encontraron materias.'));
}

// Cerrar la conexión
$conn->close();
?>
