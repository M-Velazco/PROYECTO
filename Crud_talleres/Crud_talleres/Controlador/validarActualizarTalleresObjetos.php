<?php
require "../Modelo/conexionBasesDatos.php";
extract($_REQUEST);

$objConexion = Conectarse();

if (isset($_FILES['Talleres']) && $_FILES['Talleres']['error'] == 0) {
    $Archivo_temp = $_FILES['Talleres']['tmp_name'];
    $Archivo_nombre = $_FILES['Talleres']['name'];
    $Archivo_destino = "../Talleres/" . $Archivo_nombre;

    move_uploaded_file($Archivo_temp, $Archivo_destino);
} else {
    $Archivo_destino = $_REQUEST['ArchivoActual']; // Si no se selecciona un nuevo archivo, se mantiene el archivo actual
}

$sql = "UPDATE talleres SET Nom_taller = '$_REQUEST[Nom_taller]', Materia_taller = '$_REQUEST[Materia_taller]', Archivo = '$Archivo_destino' WHERE idtalleres = '$_REQUEST[idtalleres]'";

$resultado = $objConexion->query($sql);

if ($resultado) {
    header("location: listarTalleresObjetos.php?x=7");  // x=1 significa que se modificó correctamente
} else {
    header("location: listarTalleresObjetos.php?x=2");  // x=2 significa que no se pudo modificar
}

mysqli_close($objConexion);
?>
