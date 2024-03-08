<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    // Recuperar el correo electrónico del formulario
    $email = $_POST['email'];

    // Verificar si el usuario existe en la base de datos
    $conexion = new mysqli("localhost", "root", "sena", "digiworm_04");
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    try {
        // Buscar el usuario por correo electrónico
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $conexion->query($sql);

        if ($result && $result->num_rows > 0) {
            // Generar un token único para el usuario
            $token = bin2hex(random_bytes(16)); // Genera un token hexadecimal de 32 caracteres

            // Insertar el token en la base de datos junto con el ID del usuario y la marca de tiempo de expiración
            $user = $result->fetch_assoc();
            $user_id = $user['Idusuarios'];
            $expiry_timestamp = time() + (60 * 60); // Token válido por 1 hora
            $sql_insert_token = "INSERT INTO reset_password_tokens (user_id, token, expiry_timestamp) VALUES ('$user_id', '$token', '$expiry_timestamp')";
            if (!$conexion->query($sql_insert_token)) {
                throw new Exception("Error al insertar el token en la base de datos: " . $conexion->error);
            }

            // Enviar correo electrónico al usuario con el enlace de recuperación de contraseña
            $reset_link = "http://localhost/PROYECTO/DIGIWORM..04/recovery.php?token=$token";
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'digiworm04@gmail.com';
            $mail->Password = 'dvlg rorn frlt jtgy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('digiworm04@gmail.com', 'Digiworm');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "Hola,<br><br>Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para restablecerla: <a href='$reset_link'>Restablecer contraseña</a>";
            $mail->send();
            echo "Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.";
        } else {
            echo "No se encontró ningún usuario con ese correo electrónico.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $conexion->close();
}
?>
