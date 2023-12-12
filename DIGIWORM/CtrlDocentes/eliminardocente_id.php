<?php
// Include the database connection and any necessary configurations
require ( "../ctrlDocentes/modeloDocentes/Docentes.php");
require "../ctrlDocentes/modeloDocentes/conexion.php"; // Asegúrate de que la ubicación sea correcta

// Verificar si se envió la identificación desde el formulario
if (isset($_POST['IDdocente'])) {
    $IDdocente = $_POST['IDdocente'];

    // Realizar la consulta
    $objConexion=Conectarse();
    $objdocente = new Docentes();
    
    $resultado=$objdocente->consultardocentes_id($IDdocente);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
       
        // Iterar sobre los resultados y mostrarlos en una tabla
        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listar pacientes:)</title>
</head>

<body>
<h1 align="center"> LISTAR PACIENTES</h1>
<table width="89%" border="0" align="center">
  <tr align="center" bgcolor="#FFFF99">
  <td width="10%">Identificacion Docente</td>
            <td width="12%">Nombre Docente</td>
            <td width="12%">Correo</td> <!-- Add columns for other properties -->
            <td width="12%">Contraseña</td>
            <td width="12%">Curso_pr</td>
            <td width="12%">Materia</td>
    
    
    <td width="10%">Eliminar</td> 
    
  </tr>
  
  <?php
  //vamos agregar cada fila de la tabla de acuerdo al número de empleados de forma dinamica
  while ($docente = $resultado->fetch_object())
  {
	?>
	<tr bgcolor="#CCCCFF">
        
    <<td><?php echo $docente->iddocente ?> </td>
                <td><?php echo $docente->Nombre_apellido ?></td>
                <td><?php echo $docente->Correo ?></td>
                <td><?php echo $docente->Contraseña ?></td>
                <td><?php echo $docente->Curso_pr ?></td>
                <td><?php echo $docente->Materia ?></td>
        
        
                <td align="center"><a href="eliminarDocente.php?IDdocente=<?php echo $docente->iddocente?>"><img src="img/Eliminar.jpg" width="29" height="24" /></a></td>
        
    </tr>
  <?php
  } }  }
  ?>
</table>