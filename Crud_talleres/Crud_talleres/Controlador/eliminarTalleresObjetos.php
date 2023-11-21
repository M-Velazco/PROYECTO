<?php
require "../Modelo/conexionBasesDatos.php";
extract($_REQUEST);

$objConexion = Conectarse();

// Obtener el nombre del archivo antes de eliminar el registro
$sql_archivo = "SELECT Archivo FROM talleres WHERE idtalleres = '$idtalleres'";
$resultado_archivo = $objConexion->query($sql_archivo);

if ($resultado_archivo->num_rows > 0) {
    $fila = $resultado_archivo->fetch_assoc();
    $archivo_a_eliminar = $fila['Archivo'];

    // Eliminar el archivo
    if (unlink($archivo_a_eliminar)) {
        // Eliminar el registro de la base de datos
        $sql_eliminar = "DELETE FROM talleres WHERE idtalleres = '$idtalleres'";
        $resultado_eliminar = $objConexion->query($sql_eliminar);

        if ($resultado_eliminar) {
            header("location: listarTalleresObjetos.php?x=3");  // x=3 significa que se eliminó bien
        } else {
            header("location: listarTalleresObjetos.php?x=4");  // x=4 significa que no se pudo eliminar el registro
        }
    } else {
        header("location: listarTalleresObjetos.php?x=4");  // x=4 significa que no se pudo eliminar el archivo
    }
} else {
    header("location: listarTalleresObjetos.php?x=4");  // x=4 significa que no se encontró el registro
}

$objConexion->close();
?>
