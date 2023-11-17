<?php
session_start();
extract ($_REQUEST);
if (!isset($_SESSION['user']))
	
if (!isset($_REQUEST['pg']))
	$pg="vistaDocentes/pgInicialDocentes";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consultorio Docentes </title>
<style type="text/css">
#divContenedor {
	
	left:13px;
	top:19px;
	width:1073px;
	height:700px;
	z-index:1;
	margin:0 auto;
}
#divEncabezado {
	
	left:26px;
	top:27px;
	width:1047px;
	height:98px;
	z-index:2;
	background-color:#8eefce 
}
#divMenu {

	left:26px;
	top:136px;
	width:173px;
	height:400px;
	z-index:3;
	background-color:#ef7aec
}
#divContenido {
	position:absolute;
	left:320px;
	top:120px;
	width:858px;
	height:350px;
	z-index:4;
	overflow:auto
	}
#divPiePagina {
	left:25px;
	top:442px;
	width:1045px;
	height:77px;
	z-index:5;
	background-color:#8eefce 
}

</style>
</head>

<body>
<div id="divContenedor">
    <div id="divEncabezado"> <?php include "vistaDocentes/encabezado.php";?></div>
    <div id="divMenu">
      <table width="86%" height="254" border="0" align="center">
        <tr>
          <td align="center"><a href="vistaPrincipalDocentes.php?pg=Docentes_id">Docente por Id</a></td>
        </tr>
         <tr>
          <td align="center"><a href="vistaPrincipalDocentes.php?pg=Docentes_id_act">Actualizar Docente por Id</a></td>
        </tr>
        <tr>
          <td align="center"><a href="vistaPrincipalDocentes.php?pg=Docentes_id_eliminar">Eliminar Docente por Id</a></td>
        </tr>
          <tr>
          <td align="center"><a href="vistaPrincipalDocentes.php?pg=listarDocente">Cantidad de Docentes</a></td>
        </tr>
         <tr>
          <td align="center"><a href="vistaPrincipalDocentes.php?pg=frmagregarDocente">Agregar Docente con Objetos</a></td>
        </tr>
        <tr>
          <td align="center"><a href="vistaPrincipalDocentes.php?pg=listarDocente">Listar Docente con Objetos</a></td>
        </tr>
        <tr>
          <td align="center"><a href="vistaPrincipalDocentes.php">vistaPrincipalDocentes.php">volver</a></td>
        </tr>
        <tr>
          <td align="center"><a href="salir.php">Salir</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <div id="divContenido">
        <?php include $pg.".php"; ?>
      </div>
    </div>
    <div id="divPiePagina"> <?php include "vistaDocentes/piePagina.php";?></div>    
</div>
</body>
</html>