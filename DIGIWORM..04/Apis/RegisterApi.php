<?php
require_once('ConexionApi.php'); // Asegúrate de que 'ConexionApi.php' sea el nombre correcto de tu archivo de conexión

// Establecer encabezados para permitir el acceso desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del cuerpo de la solicitud POST (json)
    $data = json_decode(file_get_contents("php://input"));

    // Validar que se hayan recibido todos los datos necesarios para el registro
    if (!empty($data->Idusuarios) && !empty($data->Nombres) && !empty($data->Apellidos) && !empty($data->Email) && !empty($data->Telefono) && !empty($data->Pasword)) {

        // Sanitizar y escapar los datos para evitar inyección SQL
        $Idusuarios = mysqli_real_escape_string($conn, $data->Idusuarios);
        $Nombres = mysqli_real_escape_string($conn, $data->Nombres);
        $Apellidos = mysqli_real_escape_string($conn, $data->Apellidos);
        $Email = mysqli_real_escape_string($conn, $data->Email);
        $Telefono = mysqli_real_escape_string($conn, $data->Telefono);
        $Pasword = mysqli_real_escape_string($conn, $data->Pasword);

        // Definir valores predeterminados para campos automáticos
        $img = ''; // Puedes ajustar esto según tus necesidades
        $Rol = 'Usuario'; // Rol por defecto es Usuario
        $Estado = 'Activo'; // Estado por defecto es Activo
        $status = 'offline'; // Status por defecto es offline

        // Consulta SQL para insertar un nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (Idusuarios, Nombres, Apellidos, Email, Telefono, Pasword, img, Rol, Estado, status)
                VALUES ('$Idusuarios', '$Nombres', '$Apellidos', '$Email', '$Telefono', '$Pasword', '$img', '$Rol', '$Estado', '$status')";

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
        echo json_encode(array("mensaje" => "Por favor, proporciona todos los campos requeridos"));
    }

} else {
    // Método de solicitud no válido
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("mensaje" => "Método no permitido"));
}

// Cerrar conexión
$conn->close();
?>
