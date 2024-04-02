<?php
require "../modelo/USUARIO.php";
require "../modelo/conexion.php";

// Verificar si se reciben los datos del formulario
if(isset($_POST['Materia'], $_POST['Pasword'], $_POST['Idusuario'], $_POST['Nombres'], $_POST['Apellidos'], $_POST['Email'], $_POST['Telefono'], $_POST['Rol'], $_POST['Estado'], $_POST['Curso'], $_POST['Jornada'])) {

    // Recoger datos del formulario
    $materia = 0;
    $contrasena = $_POST['Pasword'];
    $paswordmd5 = md5($contrasena);
    $Estado = "Activo";
    $curso = 0;
    $Jornada = "";
   

    // Verificar si se subió una imagen
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

    // Crear instancia de la clase Usuario
    $objUsuario = new Usuario();

    // Llamar al método para crear el usuario
    $objUsuario->crearUsuario(
        $_POST['Idusuario'],
        $_POST['Nombres'],
        $_POST['Apellidos'],
        $_POST['Email'],
        $_POST['Telefono'],
        $paswordmd5,
        $img,
        $_POST['Rol'],
        $Estado,
        $curso,
        $materia,
        $Jornada
    );

    // Llamar al método para agregar el usuario
    $resultado = $objUsuario->agregarUsuario();

    if ($resultado) {
        
        header("Location: " . $_SERVER['HTTP_REFERER']); // Redireccionar si se agregó correctamente
    } else {
        echo "No se ha registrado correctamente"; // Mostrar mensaje de error si falla
    }
} else {
    echo "No se han recibido todos los datos del formulario.";
}
?>
