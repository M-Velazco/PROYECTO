<?php
require "../Modelo/conexionBasesDatos.php";
require "../Modelo/Cursos.php";

extract($_REQUEST);

if (!isset($_REQUEST['x']))
    $_REQUEST['x'] = 0;

$objConexion = Conectarse();
$objCursos = new Curso();

$resultado = $objCursos->consultarCursos();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listar Cursos</title>
</head>

<body>
<h1 align="center">LISTAR CURSOS</h1>
<table width="89%" border="0" align="center">
  <tr align="center" bgcolor="#FFFF99">
    <td width="11%">ID del Curso</td>
    <td width="16%">Nombre del Curso</td>
    <td width="11%">Estado</td>
    <td width="7%">Editar</td>
  </tr>

  <?php
  while ($curso = $resultado->fetch_object()) {
    ?>
    <tr bgcolor="#CCCCFF">
        <td><?php echo $curso->idcurso ?></td>
        <td><?php echo $curso->nom_curso ?></td>
        <td><?php echo $curso->estado ?></td>
        <td align="center"><a href="frmActualizarCursosObjetos.php?idcurso=<?php echo $curso->idcurso ?>"><img src="../Imagenes/editar.jpg" width="29" height="24" /></a></td>
    </tr>
  <?php
  }
  ?>
</table>

<p>
<?php
if ($_REQUEST['x'] == 1)
  echo "Se ha actualizado el Curso correctamente";
if ($_REQUEST['x'] == 2)
  echo "Problemas al actualizar el Curso";
if ($_REQUEST['x'] == 3)
  echo "Se ha eliminado el Curso correctamente";
if ($_REQUEST['x'] == 4)
  echo "Problemas al eliminar el Curso";
if ($_REQUEST['x'] == 5)
  echo "Se ha insertado el Curso correctamente";
if ($_REQUEST['x'] == 6)
  echo "Problemas al insertar el Curso";
?>
<table>
<tr>
    <td align="center"><a href="vistaPrincipal.php">Menú Principal</a></td>
</tr>
</table>
</body>
</html>
