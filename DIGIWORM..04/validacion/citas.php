<?php
// Cargar la biblioteca PHPMailer
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once "../modelo/conexion.php";
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Insertar en la base de datos
    // Suponiendo que tienes una conexión a la base de datos establecida previamente
    $conexion = Conectarse();
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO citas (nombre, email, fecha, hora) VALUES ('$nombre', '$email', '$fecha', '$hora')";
    if ($conexion->query($sql) === TRUE) {
        // Enviar correo de confirmación utilizando PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurar el servidor SMTP (en este caso, Gmail)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'digiworm04@gmail.com'; // Tu dirección de correo electrónico de Gmail
            $mail->Password = 'dvlg rorn frlt jtgy'; // Tu contraseña de Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // Puerto SMTP para TLS/STARTTLS

            // Configurar remitente y destinatario
            $mail->setFrom('Digiworm04@gmail.com', 'Digiworm');
            $mail->addAddress($email, $nombre);

            // Configurar el contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Agendamiento Cita Matricula';
            $mail->Body    = "Estimado $nombre,<br><br>Su cita para el día $fecha a las $hora ha sido confirmada.<br><br>Gracias.";

            // Enviar el correo
            $mail->send();

            header("location:../index.html?succes=citas");
        } catch (Exception $e) {
            echo "Error al enviar el correo de confirmación: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error al registrar la cita: " . $conexion->error;
    }

    $conexion->close();
}
?>
