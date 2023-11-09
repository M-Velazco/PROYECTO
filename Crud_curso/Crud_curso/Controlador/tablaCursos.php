<?php
require "../Modelo/conexionBasesDatos.php";

$objConexion = Conectarse();

$sql = "SELECT * FROM curso";

$resultado = $objConexion->query($sql);

$cantidadCursos = $resultado->num_rows;

echo "<br> Cantidad de Cursos en la Base de Datos: " . $cantidadCursos;
echo "<br>";

// Imprimir en pantalla los datos del curso
while ($curso = $resultado->fetch_object()) {
    echo "<br> ID del Curso: " . $curso->idcurso;
    echo "<br> Nombre del Curso: " . $curso->nom_curso;
    echo "<br> Estado: " . $curso->estado;
    echo "<br>";
    echo "<br>";
}
?>
