<?php
// Conexión a la base de datos (reemplaza con tus propios detalles de conexión)
require_once "../modelo/conexion.php";

$conn = Conectarse();
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados por la solicitud AJAX
$newState = $_POST['newState'];
$cursoID = $_POST['cursoID'];

// Actualizar el estado en la tabla "estudiante"
$sql = "UPDATE curso SET Estado = ? WHERE idCurso = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newState, $cursoID);

if ($stmt->execute()) {
    echo "El estado se ha actualizado correctamente en la tabla 'Curso'.";
} else {
    echo "Error al actualizar el estado en la tabla 'Curso': " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
