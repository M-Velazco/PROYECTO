<?php
// Incluye los archivos necesarios y crea una instancia de la clase Usuario
require_once "../modelo/Usuario.php";
require_once "../modelo/conexion.php";

// Inicia la sesión
session_start();

// Comprueba si se ha enviado el formulario y si los campos no están vacíos
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['Idusuario']) && !empty($_POST['Contraseña'])) {
    // Obtiene los datos del formulario
    $Idusuario = $_POST['Idusuario'];
    $Contraseña = $_POST['Contraseña'];

    // Calcula el hash MD5 de la contraseña ingresada (esto es inseguro, considera usar una función hash más segura)
    $Contraseña_md5 = md5($Contraseña);

    // Crea una instancia de la clase Usuario y conecta a la base de datos
    $objConexion = Conectarse();
    $objUsuarios = new Usuario($objConexion);

    // Intenta realizar el inicio de sesión
    if ($objUsuarios->consultarUsuarioContraseña($Idusuario, $Contraseña_md5)) {
        // Verifica el estado del usuario
        $estado_usuario = $objUsuarios->obtenerEstadoUsuario($Idusuario);

        if ($estado_usuario == 'Activo') {
            // Inicio de sesión exitoso, establece la variable de sesión
            $_SESSION['Idusuario'] = $Idusuario;
            $_SESSION['rol_usuario'] = $objUsuarios->obtenerRolUsuario($Idusuario);

            // Redirige según el rol del usuario
            switch ($_SESSION['rol_usuario']) {
                case 'Docente':
                    header("Location: ../index04.php");
                    exit();
                case 'Padre_Familia':
                    header("Location: Visual_padres");
                    exit();
                case 'Estudiante':
                    header("Location: ../index04.php");
                    exit();
                case 'Coordinador':
                    header("Location: ../index04.php");
                    exit();
                default:
                    header("Location: ../index04.php");
                    exit();
            }
        } else {
            // Usuario inactivo, redirige a la página de inicio de sesión con un mensaje de error
            header("Location: ../form.php?error=usuario_inactivo");
            exit();
        }
    } else {
        // Inicio de sesión fallido, redirige a la página de inicio de sesión con un mensaje de error
        header("Location: ../form.php?error=usuario_no_encontrado");
        exit();
    }
} else {
    // Si alguno de los campos está vacío, muestra un mensaje de error
    header("Location: ../form.php?error=campo_incompleto");
    exit();
}

?>
