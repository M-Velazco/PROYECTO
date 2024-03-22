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
    $password = $_POST['password'];
     // Ten en cuenta que este valor se envía en texto plano, deberías encriptarlo antes de almacenarlo
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];
    if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // Directorio donde se guardará la imagen (ajusta esto según tu estructura de carpetas)
        $directorio_destino = "../img/";
        
        // Generar un nombre único para la imagen
        $nombre_archivo = uniqid('img_') . '_' . $_FILES['img']['name'];

        // Ruta completa donde se guardará la imagen
        $ruta_archivo = $directorio_destino . $nombre_archivo;

        $ruta="img/";

        // Mover el archivo cargado al directorio de destino
        if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta_archivo)) {
            // Asignar la ruta de la imagen al campo img
            $img = $ruta . $nombre_archivo;
        } else {
            echo "Error al mover el archivo de imagen.";
            exit;
        }
    }

    // Actualizar los datos del usuario en la base de datos
    $actualizacionExitosa = $objUsuarios->actualizarDatosUsuario($idUsuario, $nombres, $apellidos, $email, $telefono, $password, $img, $rol, $estado, NULL, $objConexion);

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
