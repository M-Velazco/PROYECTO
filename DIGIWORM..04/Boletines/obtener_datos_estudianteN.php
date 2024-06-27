<?php
require_once "../modelo/conexion.php";

$conn = Conectarse();
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de docente enviado por la solicitud AJAX
$id_Estudiante = $_GET['id'];

// Consulta para obtener la información del docente seleccionado
$sql = "SELECT * FROM estudiante WHERE idEstudiante = $id_Estudiante";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Convertir los resultados de la consulta a un array asociativo
    $row = $result->fetch_assoc();
    // Convertir el array asociativo a formato JSON y enviarlo
    echo json_encode($row);
} else {
    echo "No se encontró ningún Estudiante con ese ID";
}

// Cerrar conexión
$conn->close();
?>
