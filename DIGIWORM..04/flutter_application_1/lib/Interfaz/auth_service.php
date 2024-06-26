<?php
// Conexión a la base de datos MySQL
$servername = "localhost";
$username = "tu_usuario";
$password = "sena";
$database = "digiworm_04";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para autenticar usuario
function authenticateUser($email, $password) {
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario autenticado correctamente
        return true;
    } else {
        // Error de autenticación
        return false;
    }
}

// Manejar la solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "login") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (authenticateUser($email, $password)) {
            echo json_encode(["success" => true, "message" => "Usuario autenticado"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error de autenticación"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Acción no válida"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}

// Cerrar conexión
$conn->close();
?>
