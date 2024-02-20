<?php
// Incluye los archivos necesarios y crea una instancia de la clase Usuario
require_once "../modelo/Usuario.php";
require_once "../modelo/conexion.php";

// Comprueba si se ha enviado el formulario y si los campos no están vacíos
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['Idusuario']) && !empty($_POST['Contraseña'])) {
    // Obtiene los datos del formulario
    $Idusuarios = $_POST['Idusuario'];
    $Pasword = $_POST['Contraseña'];

    // Calcula el hash MD5 de la contraseña ingresada
    $Paswordmd5 = md5($Pasword);

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);

    // Intenta realizar el inicio de sesión
    if ($objUsuarios->consultarUsuarioContraseña($Idusuarios, $Paswordmd5)) {
        // Inicio de sesión exitoso, redirige a la página de inicio
        header("location:../Principal.html");
        exit(); // Detiene la ejecución del script después de redirigir
    } else {
        // Inicio de sesión fallido, muestra un mensaje de error
        $mensajeError = "Nombre de usuario o contraseña incorrectos";
        echo "Inicio de sesión fallido. $mensajeError";
    }
} else {
    // Si alguno de los campos está vacío, muestra un mensaje de error
    echo "Por favor, complete todos los campos del formulario.";
}
?>