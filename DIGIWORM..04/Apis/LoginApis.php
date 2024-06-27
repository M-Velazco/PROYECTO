<?php
require_once('ConexionApi.php'); // Reemplaza 'ConexionApi.php' con el nombre correcto de tu archivo de conexión

// Establecer encabezados para permitir el acceso desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del cuerpo de la solicitud POST (json)
    $data = json_decode(file_get_contents("php://input"));

    // Validar que se hayan recibido los datos de idUsuario y password
    if (!empty($data->idUsuario) && !empty($data->password)) {

        // Sanitizar y escapar los datos para evitar inyección SQL
        $idUsuario = mysqli_real_escape_string($conn, $data->idUsuario);
        $password = mysqli_real_escape_string($conn, $data->password);

        // Consulta SQL para verificar las credenciales del usuario
        $sql = "SELECT Idusuarios, Pasword FROM usuarios WHERE Idusuarios='$idUsuario' AND Pasword='$password'";
        $resultado = $conn->query($sql);

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($resultado->num_rows == 1) {
            // Usuario autenticado correctamente
            $usuario = $resultado->fetch_assoc();
            echo json_encode(array("mensaje" => "Inicio de sesión exitoso", "usuario" => $usuario));
        } else {
            // Error de autenticación
            http_response_code(401); // Unauthorized
            echo json_encode(array("mensaje" => "Credenciales incorrectas"));
        }

    } else {
        // Datos incompletos
        http_response_code(400); // Bad Request
        echo json_encode(array("mensaje" => "Por favor, proporciona idUsuario y contraseña"));
    }

} else {
    // Método de solicitud no válido
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("mensaje" => "Método no permitido"));
}

// Cerrar conexión
$conn->close();
?>
