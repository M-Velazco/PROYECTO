<?php
header("Access-Control-Allow-Origin: *"); // Allow access from any origin
header("Access-Control-Allow-Headers: Content-Type");

// Database credentials
$servername = "localhost";
$username = "root"; // Tu nombre de usuario de MySQL
$password = "sena"; // Tu contraseña de MySQL
$dbname = "digiworm_04"; // Nombre de tu base de datos

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive JSON POST data from Flutter
$json = file_get_contents('php://input');
$data = json_decode($json);

// Extract data
$Idusuarios = (int)$data->Idusuarios;
$Nombres = $data->Nombres;
$Apellidos = $data->Apellidos;
$Email = $data->Email;
$Telefono = (int)$data->Telefono;
$pasword = $data->pasword;

// Default values for other fields
$img = "";
$Rol = "Usuario";
$Estado = "Activo";
$status = "offline";

// Prepare SQL statement
$sql = "INSERT INTO usuarios (Idusuarios, Nombres, Apellidos, Email, Telefono, Pasword, img, Rol, Estado, status)
        VALUES ('$Idusuarios', '$Nombres', '$Apellidos', '$Email', '$Telefono', '$pasword', '$img', '$Rol', '$Estado', '$status')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    // Return success response
    http_response_code(201); // Created
    echo json_encode(array("message" => "Registro exitoso"));
} else {
    // Return error response
    http_response_code(500); // Internal Server Error
    echo json_encode(array("message" => "Error al registrar: " . $conn->error));
}

// Close database connection
$conn->close();
?>