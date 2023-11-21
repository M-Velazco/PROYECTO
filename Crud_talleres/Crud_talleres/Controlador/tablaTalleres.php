<?php
require "../Modelo/conexionBasesDatos.php";

$objConexion = Conectarse();

$sql = "SELECT * FROM talleres"; 
$resultado = $objConexion->query($sql);

$cantidadTalleres = $resultado->num_rows; 

echo "<br> Cantidad de Talleres en la Base de Datos: " . $cantidadTalleres; 
echo "<br>";

// Imprimir en pantalla los datos del taller
while ($taller = $resultado->fetch_object()) {
    echo "<br> ID del Taller: " . $taller->idtalleres; 
    echo "<br> Nombre del Taller: " . $taller->Nom_taller; 
    echo "<br> Materia del Taller: " . $taller->Materia_taller; 
    echo "<br> Docente: " . $taller->Docente; 
    echo "<br> Archivo: " . $taller->Archivo; 
    echo "<br>";
    echo "<br>";
}
?>

