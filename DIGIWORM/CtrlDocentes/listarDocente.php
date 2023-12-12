<?php
require ( "../ctrlDocentes/modeloDocentes/Docentes.php");
require "../ctrlDocentes/modeloDocentes/conexion.php";

	
extract ($_REQUEST);
if (!isset($_REQUEST['x']))
	$_REQUEST['x']=0;

$objConexion=Conectarse();
$objDocentes = new Docentes();

$resultado=$objDocentes->consultarDocentes();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<title>Listar Docentes:)</title>
</head>

<body>
<h1 align="center"> Lista Docentes</h1>
<table width="89%" border="0" align="center">
  <tr align="center" bgcolor="46e9f7">
  <td width="10%">Identificacion Docente</td>
            <td width="12%">Nombre Docente</td>
            <td width="12%">Correo</td> <!-- Add columns for other properties -->
            <td width="12%">Contraseña</td>
            <td width="12%">Curso_pr</td>
            <td width="12%">Materia</td>

    <td width="7%">Editar</td>
     
    <td width="10%">agregar</td> 
    <td width="10%">Eliminar</td> 
  </tr>
  
  <?php
  //vamos agregar cada fila de la tabla de acuerdo al número de empleados de forma dinamica
  while ($docente = $resultado->fetch_object())
  {
	?>
	<tr bgcolor="c1c1c1">
  <td><?php echo $docente->iddocente ?> </td>
                <td><?php echo $docente->Nombre_apellido ?></td>
                <td><?php echo $docente->Correo ?></td>
                <td><?php echo $docente->Contraseña ?></td>
                <td><?php echo $docente->Curso_pr ?></td>
                <td><?php echo $docente->Materia ?></td>
        
        
        <td align="center"><a href="frmactualizarDocente.php?iddocente=<?php echo $docente->iddocente?>"><i class="fa-solid fa-user-pen" style="text-decoration:None;" width="29" height="24"></i></a></td>
        <td align="center"><a href="frmagregarDocente.php?"><i class="fa-solid fa-user-plus" style="text-decoration:None;" width="29" height="24"></i></a></td>
        <td align="center"><a href="eliminarDocente.php?IDdocente=<?php echo $docente->iddocente?>"><i class="fa-solid fa-eraser" style="text-decoration:None;" width="29" height="24" ></i></a></td>
  
    </tr>
  <?php
  }
  ?>
</table>

<p>
<?php

if ($_REQUEST['x']==5)
  echo "Se ha insertado el Empleado correctamente";
if ($_REQUEST['x']==6)
  echo "Problemas al insertar el Empleado";

?>
<table>
<tr>
    <td align="center"><a href="../CtrlDocentes\vistaPrincipalDocentes.php">Menu Principal</a></td>
</tr>
</table>
</body>
</html>