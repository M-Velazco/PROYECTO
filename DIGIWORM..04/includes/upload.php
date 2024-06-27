<?php
include_once "../modelo/conexion.php";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registrar'])) {
    // Obtener los datos del formulario
    $nombre_actividad = $_POST['nombreA'];
    $materia = $_POST['Materia'];
    $docente = $_POST['Docente'];
    $fecha_entrega = $_POST['FechaEntrega'];
    $descripcion = $_POST['Descripcion']; // Obtener la descripción del formulario

    // Generar la fecha de publicación automáticamente
    $fecha_publicacion = date('Y-m-d');

    // Manejar el archivo enviado
    if ($_FILES['Archivo']['error'] === UPLOAD_ERR_OK) {
        // Definir la carpeta de destino para guardar el archivo
        $carpeta_destino = "./files/";

        // Obtener el nombre y la extensión del archivo
        $nombre_archivo = basename($_FILES["Archivo"]["name"]);

        // Mover el archivo a la carpeta de destino
        $archivo_destino = $carpeta_destino . $nombre_archivo;
        if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $archivo_destino)) {
            // El archivo se ha movido correctamente, ahora procedemos a la inserción en la base de datos

            // Conectar a la base de datos
            $conexion = Conectarse();
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Preparar la consulta SQL para insertar los datos
            $sql = "INSERT INTO actividades (Nombre_act, Asignatura, Docente, Archivo, Estado, Descripcion, FechaEntrega, FechaPublicacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);

            // Vincular los parámetros
            $estado = 'Activo'; // Por defecto, el estado es 'Activo'
            $stmt->bind_param("ssssssss", $nombre_actividad, $materia, $docente, $nombre_archivo, $estado, $descripcion, $fecha_entrega, $fecha_publicacion);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // La inserción fue exitosa
                echo "<script>alert('Registro insertado correctamente');</script>";
                header('location:../Actividades.php');
            } else {
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
        // No se ha enviado un archivo, mostrar un mensaje de error
        echo "<script>alert('No se ha seleccionado ningún archivo');</script>";
    }
}
?>
