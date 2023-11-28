<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Recibe los datos del formulario Angular
$data = json_decode(file_get_contents('php://input'), true);

// Establece la conexión a tu base de datos (ajusta los detalles según tu configuración)
require("conexion.php");
$con = retornarConexion();

// Verifica la conexión
if ($con->connect_error) {
    die("Error de conexión a la base de datos: " . $con->connect_error);
}

// Escapa los datos para prevenir inyección de SQL
$idusuarios = mysqli_real_escape_string($con, $data['Idusuarios']);
$contrasena = mysqli_real_escape_string($con, $data['Contrasena']);

// Verifica si el usuario existe en la tabla 'usuarios'
$sqlVerificarUsuario = "SELECT * FROM usuarios WHERE idusuarios = '$idusuarios' AND Contraseña = '$contrasena'";
$resultadoVerificarUsuario = $con->query($sqlVerificarUsuario);

if ($resultadoVerificarUsuario->num_rows > 0) {
    // El usuario existe, inicio de sesión exitoso
    $con->close();
    echo json_encode(['success' => true]);
    exit;
} else {
    // El usuario no existe o las credenciales son incorrectas
    $con->close();
    echo json_encode(['success' => false, 'error' => 'Credenciales incorrectas']);
    exit;
}
