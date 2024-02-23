<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registrar'])) {
    // Verificar si se ha enviado el formulario y se ha hecho clic en el botón de guardar

    // Obtener los datos del formulario
    $nombre_act = $_POST['nombreA'];
    $materia = $_POST['Materia'];
    $docente = $_POST['Docente'];
    $estado = $_POST['Estado'];

    // Manejar el archivo enviado
    if ($_FILES['Archivo']['error'] === UPLOAD_ERR_OK) {
        // Definir la carpeta de destino para guardar el archivo
        $carpeta_destino = "files/";

        // Obtener el nombre y la extensión del archivo
        $nombre_archivo = basename($_FILES["Archivo"]["name"]);

        // Mover el archivo a la carpeta de destino
        $archivo_destino = $carpeta_destino . $nombre_archivo;
        if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $archivo_destino)) {
            // El archivo se ha movido correctamente, ahora procedemos a la inserción en la base de datos

            // Conectar a la base de datos
            $conexion = new mysqli("localhost", "root", "", "digiworm_04");
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Preparar la consulta SQL para insertar los datos
            $sql = "INSERT INTO `actividades`(`Nombre_act`, `Asignatura`, `Docente`, `Archivo`, `Estado`) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);

            // Vincular los parámetros
            $stmt->bind_param("sssss", $nombre_act, $materia, $docente, $nombre_archivo, $estado);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // La inserción fue exitosa
                echo "<script>alert('Registro insertado correctamente');</script>";
            } else {
                // Ocurrió un error durante la inserción
                  // Ocurrió un error durante la inserción
    echo "<script>alert('Error al insertar el registro: " . $stmt->error . "');</script>";
            }

            // Cerrar la conexión y liberar los recursos
            $stmt->close();
            $conexion->close();
        } else {
            // Error al mover el archivo
            echo "<script>alert('Error al subir el archivo');</script>";
        }
    } else {
        // Error al cargar el archivo
        echo "<script>alert('Error al cargar el archivo');</script>";
    }
}
?>
