<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registrar'])) {
    // Verificar si se ha enviado el formulario y se ha hecho clic en el botón de guardar

    // Obtener el ID de la actividad
    $idActividad = $_GET['idActividades'];

    // Obtener los datos del formulario
    $nombre_act = $_POST['nombreA'];
    $materia = $_POST['Materia'];
    $docente = $_POST['Docente'];
    $estado = $_POST['estado'];

    // Manejar el archivo enviado
    if ($_FILES['Archivo']['error'] === UPLOAD_ERR_OK) {
        // Definir la carpeta de destino para guardar el archivo
        $carpeta_destino = "files/";

        // Obtener el nombre y la extensión del archivo
        $nombre_archivo = basename($_FILES["Archivo"]["name"]);

        // Mover el archivo a la carpeta de destino
        $archivo_destino = $carpeta_destino . $nombre_archivo;
        if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $archivo_destino)) {
            // El archivo se ha movido correctamente, ahora procedemos a la actualización en la base de datos

            // Conectar a la base de datos
            $conexion = new mysqli("localhost", "root", "", "digiworm_04");
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Preparar la consulta SQL para actualizar los datos
            $sql = "UPDATE `actividades` SET `Nombre_act`=?, `Asignatura`=?, `Docente`=?, `Archivo`=?, `Estado`=? WHERE `idActividades`=?";
            $stmt = $conexion->prepare($sql);

            // Vincular los parámetros
            $stmt->bind_param("sssssi", $nombre_act, $materia, $docente, $nombre_archivo, $estado, $idActividad);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // La actualización fue exitosa
                echo "<script>alert('Registro actualizado correctamente');</script>";
            } else {
                // Ocurrió un error durante la actualización
                echo "<script>alert('Error al actualizar el registro: " . $stmt->error . "');</script>";
            }

            // Cerrar la conexión y liberar los recursos
            $stmt->close();
            $conexion->close();
        } else {
            // Error al mover el archivo
            echo "<script>alert('Error al subir el archivo');</script>";
        }
    } else {
        // No se ha enviado un nuevo archivo, procedemos a actualizar solo los otros campos en la base de datos

        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "root", "", "digiworm_04");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Preparar la consulta SQL para actualizar los datos sin el archivo
        $sql = "UPDATE `actividades` SET `Nombre_act`=?, `Asignatura`=?, `Docente`=?, `Estado`=? WHERE `idActividades`=?";
        $stmt = $conexion->prepare($sql);

        // Vincular los parámetros
        $stmt->bind_param("ssssi", $nombre_act, $materia, $docente, $estado, $idActividad);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // La actualización fue exitosa
            echo "<script>alert('Registro actualizado correctamente');</script>";
        } else {
            // Ocurrió un error durante la actualización
            echo "<script>alert('Error al actualizar el registro: " . $stmt->error . "');</script>";
        }

        // Cerrar la conexión y liberar los recursos
        $stmt->close();
        $conexion->close();
    }
}
?>
