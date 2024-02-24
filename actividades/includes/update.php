<?php
if (isset($_POST['registrar'])) {
    $idactividades = $_GET['idActividades']; // Obtén el ID del registro a actualizar
    $nombreA = $_POST['nombreA'];
    $Materia = $_POST['Materia'];
    $docente = $_POST['Docente'];
    $estado = $_POST['Estado'];
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["Archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));
    // Verifica si se ha enviado un nuevo archivo
    if (move_uploaded_file($_FILES["Archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
        require_once "../includes/db.php"; // Asegúrate de incluir la conexión a la base de datos

        $sql = "UPDATE actividades SET Nombre_act = '$nombreA', Asignatura = '$Materia', Docente = '$docente', Archivo = '$nombre_archivo', Estado = '$estado' WHERE idActividades = $idactividades";
        $resultado = mysqli_query($conexion, $sql);

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
    } else {
        echo "<script language='JavaScript'>
        alert('Error al subir el archivo.');
        location.assign('../views/index.php');
        </script>";
    }
} else {
    echo "No se envió el formulario de actualización.";
}
?>
