<?php
header("Access-Control-Allow-Origin: *"); // Permite acceso desde cualquier origen
header("Access-Control-Allow-Headers: Content-Type");

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "sena";
$dbname = "digiworm_04";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtiene los datos enviados desde la aplicación Flutter
// Obtiene los datos enviados desde la aplicación Flutter
$data = json_decode(file_get_contents("php://input"));

if (isset($data->Idusuarios) && isset($data->Pasword)) {
    $idUsuario = $data->Idusuarios;
    $password = md5($data->Pasword); // Encriptar la contraseña recibida

    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE Idusuarios = $idUsuario AND Pasword = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario y contraseña correctos
        $response = array(
            "status" => "success",
            "message" => "Inicio de sesión exitoso"
        );
    } else {
        // Credenciales incorrectas
        $response = array(
            "status" => "error",
            "message" => "Credenciales incorrectas"
        );
    }
} else {
    // Datos incompletos
    $response = array(
        "status" => "error",
        "message" => "Datos incompletos"
    );
}

// Devolver respuesta JSON a la aplicación Flutter
header('Content-Type: application/json');
echo json_encode($response);


// Cerrar conexión a la base de datos
$conn->close();

?>