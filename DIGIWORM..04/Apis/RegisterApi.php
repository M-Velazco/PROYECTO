<?php
require_once('ConexionApi.php'); // Reemplaza 'ConexionApi.php' con el nombre correcto de tu archivo de conexión

// Establecer encabezados para permitir el acceso desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del cuerpo de la solicitud POST (json)
    $data = json_decode(file_get_contents("php://input"));

    // Validar que se hayan recibido todos los datos necesarios para el registro
    if (!empty($data->nombre) && !empty($data->correo) && !empty($data->password)) {

        // Sanitizar y escapar los datos para evitar inyección SQL
        $nombre = mysqli_real_escape_string($conn, $data->nombre);
        $correo = mysqli_real_escape_string($conn, $data->correo);
        $password = mysqli_real_escape_string($conn, $data->password);

        // Consulta SQL para insertar un nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES ('$nombre', '$correo', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Registro exitoso
            http_response_code(201); // Created
            echo json_encode(array("mensaje" => "Usuario registrado correctamente"));
        } else {
            // Error en la consulta SQL
            http_response_code(500); // Internal Server Error
            echo json_encode(array("mensaje" => "Error al registrar usuario: " . $conn->error));
        }

    } else {
        // Datos incompletos
        http_response_code(400); // Bad Request
        echo json_encode(array("mensaje" => "Por favor, proporciona nombre, correo y contraseña"));
    }

} else {
    // Método de solicitud no válido
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("mensaje" => "Método no permitido"));
}

// Cerrar conexión
$conn->close();
?>
