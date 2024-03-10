<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Idusuario'])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    exit();
}

require_once "../modelo/conexion.php";
require_once "../modelo/USUARIO.php";
$objConexion = Conectarse();
$objUsuarios = new Usuario($objConexion);

// Obtener el ID del usuario
$idUsuario = $_SESSION['Idusuario'];

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password']; // Ten en cuenta que este valor se envía en texto plano, deberías encriptarlo antes de almacenarlo
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];

    // Actualizar los datos del usuario en la base de datos
    $actualizacionExitosa = $objUsuarios->actualizarDatosUsuario($idUsuario, $nombres, $apellidos, $email, $telefono, $password, $rol, $estado, NULL, $objConexion);

    // Verificar si la actualización fue exitosa
    if ($actualizacionExitosa) {
        // Redirigir a Datos.php y mostrar Sweet Alert
        echo "<script>
                window.location.href = '../Datos.php?success=actualizado';
                
              </script>";
    } else {
        // Mostrar mensaje de error
        echo "Error al actualizar los datos del usuario.";
    }
}
?>
