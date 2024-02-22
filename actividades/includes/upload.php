<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['Archivo'])) {
    // Obtener los datos del formulario
    $nombre_act = $_POST['nombreA'];
    $materia = $_POST['Materia'];
    $docente = $_POST['Docente'];
    $estado = $_POST['Estado'];

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["Archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Array de extensiones permitidas
    $extensiones_permitidas = array('pdf', 'doc', 'docx');

    if (in_array($extension, $extensiones_permitidas)) {
        // Mover el archivo a la carpeta de destino
        $archivo_destino = $carpeta_destino . $nombre_archivo;
        if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $archivo_destino)) {
            include "db.php";
            // Preparar la consulta SQL
            $sql = "INSERT INTO `actividades`(`idActividades`, `Nombre_act`, `Asignatura`, `Docente`, `Archivo`, `Estado`) 
                    VALUES ('', ?, ?, ?, ?, ?)";
            // Preparar la declaración
            $stmt = mysqli_prepare($conexion, $sql);
            // Vincular los parámetros
            mysqli_stmt_bind_param($stmt, "sssss", $nombre_act, $materia, $docente, $nombre_archivo, $estado);
            // Ejecutar la declaración
            $resultado = mysqli_stmt_execute($stmt);
            // Verificar si la inserción fue exitosa
            if ($resultado) {
                echo "<script language='JavaScript'>
                    alert('Archivo Subido');
                    location.assign('../views/index.php');
                    </script>";
            } else {
                echo "<script language='JavaScript'>
                    alert('Error al subir el archivo.');
                    location.assign('../views/index.php');
                    </script>";
            }
            // Cerrar la declaración
            mysqli_stmt_close($stmt);
            // Cerrar la conexión
            mysqli_close($conexion);
        } else {
            echo "<script language='JavaScript'>
                alert('Error al subir el archivo.');
                location.assign('../views/index.php');
                </script>";
        }
    } else {
        echo "<script language='JavaScript'>
            alert('Solo se permiten archivos PDF, DOC y DOCX.');
            location.assign('../views/index.php');
            </script>";
    }
} else {
    echo "<script language='JavaScript'>
        alert('No se ha enviado ningún archivo.');
        location.assign('../views/index.php');
        </script>";
}
?>
