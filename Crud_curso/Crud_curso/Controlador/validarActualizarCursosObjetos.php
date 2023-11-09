<?php
require "../Modelo/conexionBasesDatos.php";
extract($_REQUEST);

$objConexion = Conectarse();

$sql = "UPDATE curso SET estado = '$_REQUEST[estado]' WHERE idcurso = '$_REQUEST[idcurso]'";

$resultado = $objConexion->query($sql);

if ($resultado) {
    header("location: listarCursosObjetos.php?x=1");  // x=1 significa que se modificó correctamente
} else {
    header("location: listarCursosObjetos.php?x=2");  // x=2 significa que no se pudo modificar
}
?>
