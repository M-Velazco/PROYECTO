<?php
// Verifica si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "sena", "facturacion");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtiene los datos del formulario
    $idUsuario = $_POST["Idusuario"];
    $contraseña = $_POST["Contraseña"];

    // Escapa los caracteres especiales para prevenir inyección de SQL
    $idUsuario = $conexion->real_escape_string($idUsuario);
    $contraseña = $conexion->real_escape_string($contraseña);

    // Consulta para verificar el inicio de sesión
    $consulta = "SELECT * FROM users WHERE IdUsuario = '$idUsuario' AND Contraseña = '$contraseña'";
    $resultado = $conexion->query($consulta);

    // Verifica si se encontraron resultados
    if ($resultado->num_rows == 1) {
        // Inicio de sesión exitoso
        // Puedes redirigir al usuario a la página de inicio o realizar otras acciones necesarias
        // Por ejemplo:
        header("Location: ../views/");
        exit();
    } else {
        // Inicio de sesión fallido
        // Puedes redirigir al usuario de nuevo al formulario de inicio de sesión con un mensaje de error
        // Por ejemplo:
        header("Location: index.php?error=usuario_no_encontrado");
        exit();
    }

    // Cierra la conexión
    $conexion->close();
}
?>
