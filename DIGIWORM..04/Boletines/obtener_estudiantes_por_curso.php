<?php
// Manejar la solicitud AJAX para obtener los estudiantes asociados al curso seleccionado
require_once "../modelo/conexion.php";
// Verificar si se recibió el parámetro de curso
if (isset($_GET['curso'])) {
    // Obtener el valor del curso seleccionado
    $cursoSeleccionado = $_GET['curso'];
    
    // Conexión a la base de datos
    $conn = Conectarse();

    // Consulta para obtener los estudiantes asociados al curso seleccionado
    $sql = "SELECT idEstudiante FROM estudiante WHERE Curso = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cursoSeleccionado);
    $stmt->execute();
    $result = $stmt->get_result();

    // Array para almacenar los ID de los estudiantes asociados al curso
    $estudiantes = array();

    // Obtener los ID de los estudiantes y agregarlos al array
    while ($row = $result->fetch_assoc()) {
        $estudiantes[] = $row;
    }

    // Devolver los datos en formato JSON
    echo json_encode($estudiantes);

    // Cerrar conexión
    $stmt->close();
    $conn->close();
} else {
    // Devolver un mensaje de error si no se recibió el parámetro de curso
    echo "Error: No se recibió el parámetro de curso";
}
?>
