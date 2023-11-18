<?php
require "../Modelo/conexionBasesDatos.php";
require "../Modelo/Cursos.php";
extract($_REQUEST);

$objCurso = new Curso();

// Obtener los valores de los campos del formulario
$idcurso = $_REQUEST['idcurso'];
$nom_curso = $_REQUEST['nom_curso'];
$estado = $_REQUEST['estado'];

$objCurso->CrearCurso($idcurso, $nom_curso, $estado);

$resultado = $objCurso->agregarCurso();

if ($resultado) {
    header("location: listarCursosObjetos.php?x=1"); // x=1 significa que se agregó correctamente
} else {
    header("location: listarCursosObjetos.php?x=2"); // x=2 significa que no se pudo agregar
}
?>
