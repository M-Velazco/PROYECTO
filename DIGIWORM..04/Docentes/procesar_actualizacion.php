<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $id_docente = $_POST['id_docente'];
    $nombres = htmlspecialchars($_POST['nombres']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $email = htmlspecialchars($_POST['email']);
    $curso = $_POST['curso'];
    $materia = $_POST['materia'];
    $jornada = $_POST['jornada'];
    $Descripcion = htmlspecialchars($_POST['Descripcion']);

    // Verificar si se ha seleccionado algún archivo
    if (isset($_FILES['Archivo']) && $_FILES['Archivo']['error'] === UPLOAD_ERR_OK) {
        // Manejar el archivo enviado
        // Definir la carpeta de destino para guardar el archivo
        $carpeta_destino = "./files/";

        // Obtener el nombre y la extensión del archivo
        $nombre_archivo = basename($_FILES["Archivo"]["name"]);
        $archivo_destino = $carpeta_destino . $nombre_archivo;
        $archivo_Bd = "Docentes/files/".$nombre_archivo;
        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $archivo_destino)) {
            // El archivo se ha movido correctamente, ahora procedemos a la inserción en la base de datos

            require_once "../modelo/conexion.php";
            $conn = Conectarse();

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para actualizar los datos del docente
            $sql = "UPDATE docente SET Nombres=?, Apellidos=?, Email=?, Curso=?, Materia=?, Jornada=?, Certificacion=?, Desc_prof=? WHERE idDocente=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssiisssi", $nombres, $apellidos, $email, $curso, $materia, $jornada, $archivo_Bd, $Descripcion, $id_docente);

            if ($stmt->execute()) {
                header('Location: ../Docentes.php');
                exit;
            } else {
                echo "Error al actualizar los datos del docente: " . $stmt->error;
            }

            // Cerrar conexión
            $stmt->close();
            $conn->close();
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        // No se ha seleccionado ningún archivo o ocurrió un error al subir el archivo, continuar sin manejar el archivo
        // Puedes agregar aquí el código para procesar los otros campos del formulario
        // Si la subida del archivo es opcional, puedes simplemente continuar con la actualización de los datos del docente
        // Sin necesidad de mostrar un mensaje de error

        // Por ejemplo, podrías realizar la actualización de los datos del docente aquí sin intentar manejar un archivo inexistente
        // La lógica para actualizar los datos del docente se colocaría aquí

        // Luego puedes redirigir al usuario a la página de destino
        header('Location: ../Docentes.php');
        exit;
    }
}
?>
