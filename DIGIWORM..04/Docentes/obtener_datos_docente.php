<?php
require_once "../modelo/conexion.php";

$conn = Conectarse();
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de docente enviado por la solicitud AJAX
$id_docente = $_GET['id'];

// Consulta para obtener la información del docente seleccionado
$sql = "SELECT * FROM docente WHERE idDocente = $id_docente";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Convertir los resultados de la consulta a un array asociativo
    $row = $result->fetch_assoc();
    // Convertir el array asociativo a formato JSON y enviarlo
    echo json_encode($row);
} else {
    echo "No se encontró ningún docente con ese ID";
}

// Cerrar conexión
$conn->close();
?>
