<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Conectar a la base de datos (reemplaza con tus credenciales)
$conexion = new mysqli("nombre_del_servidor", "usuario", "contraseña", "nombre_de_la_base_de_datos");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Recibir datos del formulario Angular
$data = json_decode(file_get_contents("php://input"));

$idUsuario = $data->Idusuario;  // Reemplaza con el nombre exacto del campo en tu formulario
$password = $data->Contraseña;  // Reemplaza con el nombre exacto del campo en tu formulario

// Consulta para verificar las credenciales
$query = "SELECT * FROM usuarios WHERE idUsuario = '$idUsuario' AND password = '$password'";
$result = $conexion->query($query);

if ($result->num_rows > 0) {
    // Usuario autenticado
    echo json_encode(["success" => true, "message" => "Inicio de sesión exitoso"]);
} else {
    // Credenciales incorrectas
    echo json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
}

$conexion->close();
?>
