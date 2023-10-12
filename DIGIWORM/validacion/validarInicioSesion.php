<?php
// Incluye los archivos necesarios y crea una instancia de la clase Usuario
require_once "../modelo/Usuario.php"; // Asegúrate de que la clase se llame "Usuario" y esté en un archivo llamado "Usuario.php"
require_once "../modelo/conexion.php";

// Comprueba si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $Idusuarios = $_POST['Idusuario'];
    $Contraseña = $_POST['Contraseña'];

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);

    // Intenta realizar el inicio de sesión
    if ($objUsuarios->obtenerDatosUsuario($Idusuarios, $Contraseña)) {
        // Inicio de sesión exitoso, redirige a la página de inicio
        header("location:../Principal.html");
        exit(); // Detiene la ejecución del script después de redirigir
    } else {
        // Inicio de sesión fallido, muestra un mensaje de error
        $mensajeError = "Nombre de usuario o contraseña incorrectos";
        echo"no sirve";
    }
}
?>