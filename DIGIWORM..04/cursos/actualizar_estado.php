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
$studentId = $_POST['studentId'];

// Actualizar el estado en la tabla "estudiante"
$sql = "UPDATE estudiante SET Estado = ? WHERE idEstudiante = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newState, $studentId);

if ($stmt->execute()) {
    echo "El estado se ha actualizado correctamente en la tabla 'estudiante'.";
} else {
    echo "Error al actualizar el estado en la tabla 'estudiante': " . $conn->error;
}

// Actualizar el estado en la tabla "usuarioss"
$sql2 = "UPDATE usuarios SET Estado = ? WHERE Idusuarios = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("si", $newState, $studentId);

if ($stmt2->execute()) {
    echo "El estado se ha actualizado correctamente en la tabla 'usuarioss'.";
} else {
    echo "Error al actualizar el estado en la tabla 'usuarioss': " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
