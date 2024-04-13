<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once "../modelo/conexion.php";
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'], $_POST['confirm_password'], $_POST['token'])) {
    // Recuperar los datos del formulario
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $token = $_POST['token'];

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Conectar a la base de datos
    $conexion = Conectarse();
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Buscar el token en la base de datos y verificar si ha expirado
    $sql = "SELECT * FROM reset_password_tokens WHERE token='$token' AND expiry_timestamp >= UNIX_TIMESTAMP(NOW())";
    $result = $conexion->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Token válido, restablecer la contraseña del usuario
            $token_data = $result->fetch_assoc();
            $user_id = $token_data['user_id'];
            $hashed_password = md5($password);

            // Actualizar la contraseña del usuario en la base de datos
            $update_sql = "UPDATE usuarios SET Pasword='$hashed_password' WHERE Idusuarios='$user_id'";
            if ($conexion->query($update_sql) === TRUE) {
                // Eliminar el token de la base de datos
                $delete_sql = "DELETE FROM reset_password_tokens WHERE token='$token'";
                $conexion->query($delete_sql);
                echo "Contraseña restablecida exitosamente.";
                header( 'Location: ../form.php');
            } else {
                echo "Error al restablecer la contraseña: " . $conexion->error;
            }
        } else {
            echo "No se encontraron filas con el token proporcionado o el token ha expirado.";
        }
    } else {
        echo "Error en la consulta SQL: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Solicitud no válida.";
}
?>
