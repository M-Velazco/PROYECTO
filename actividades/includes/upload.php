<?php

// Comprobar si se ha cargado un archivo
if (isset($_FILES['Archivo'])) {
    extract($_POST);
    $nombre_act = $_POST['nombreA'];
    $materia = $_POST['Materia'];
    $docente = $_POST['docente'];

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["Archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "doc" || $extension == "docx") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos
            include "db.php";
            $sql = "INSERT INTO `actividades`(`idactividades`, `Nom_act`, `Materia_act`, `Docente`, `Archivo`) 
            VALUES ( '$nombre_act', '$materia','$docente','$nombre_archivo')";
            $resultado = mysqli_query($conexion, $sql);
            if ($resultado) {
                echo "<script language='JavaScript'>
                alert('Archivo Subido');
                location.assign('../views/index.php');
                </script>";
            } else {

                echo "<script language='JavaScript'>
                alert('Error al subir el archivo: ');         
                location.assign('../views/index.php');
                </script>";
            }
        } else {
            echo "<script language='JavaScript'>
            alert('Error al subir el archivo. ');
            location.assign('../views/index.php');
            </script>";
        }
    } else {
        echo "<script language='JavaScript'>
        alert('Solo se permiten archivos PDF, DOC y DOCX.');
        location.assign('../views/index.php');
        </script>";
    }
}
