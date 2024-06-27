<?php
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once "conexion.php"; // Asegúrate de que la ruta del archivo de conexión sea correcta

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    // Recuperar el correo electrónico del
    $email = $_POST['email'];
    // Verificar si el usuario existe en la base de datos
$conexion = Conectarse();
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

try {
    // Buscar el usuario por correo electrónico
    $sql = "SELECT * FROM usuarios WHERE Email='$email'";
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
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@gmail.com'; // Correo electrónico desde el que se enviará el mensaje
        $mail->Password = 'tu_contraseña'; // Contraseña del correo electrónico
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('tu_correo@gmail.com', 'Nombre Mostrar'); // Correo y nombre del remitente
        $mail->addAddress($email); // Correo del destinatario
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body = "Hola,<br><br>Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para restablecerla: <a href='$reset_link'>Restablecer contraseña</a>";
        $mail->send();
        echo "Correo electrónico enviado con instrucciones para restablecer tu contraseña.";
    } else {
        echo "No se encontró ningún usuario con ese correo electrónico.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conexion->close();
} else {
    echo "Solicitud no válida.";
    }
    ?>
