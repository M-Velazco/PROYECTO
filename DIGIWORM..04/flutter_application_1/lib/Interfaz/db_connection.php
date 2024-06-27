<?php
$servername = "localhost"; // Cambia esto al nombre de tu servidor MySQL si es diferente
$username = "root"; // Nombre de usuario de tu base de datos
$password = "sena"; // Contraseña de tu base de datos
$database = "Digiworm_04"; // Nombre de la base de datos que estás usando

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>