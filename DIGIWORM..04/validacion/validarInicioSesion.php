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
        // Inicio de sesión exitoso, establece la variable de sesión
        $_SESSION['Idusuario'] = $Idusuario;
        $_SESSION['rol_usuario'] = $objUsuarios->obtenerRolUsuario($Idusuario);

        // Redirige según el rol del usuario
        switch ($_SESSION['rol_usuario']) {
            case 'Docente':
                header("Location: ../index04.php");//casos foros, actividades, chats, publicaciones/no_publicar
                exit();
            case 'Padre_Familia':
                header("Location: Visual_padres");// casos de visual padres chats
                exit();
            case 'Estudiante':
                header("Location: ../index04.php");// casos foros, actividades/no_publicar, chats, publicaciones/no_publicar
                exit();
            case 'Coordinador':
                header("Location: ../index04.php");//casos foros, actividades/no_publicar,publicaciones
                exit();
            default:
                // En caso de un rol desconocido, redirige a algún lugar predeterminado
                header("Location: ../index04.php");
                exit();
        }
    } else {
        // Inicio de sesión fallido, redirige a la página de inicio de sesión con un mensaje de error
        header("Location: ../form.php?error=usuario_no_encontrado");
        exit;
    }
} else {
    // Si alguno de los campos está vacío, muestra un mensaje de error
    header("Location: ../form.php?error=campo_incompleto");
    exit;
}
?>
