<?php
require ( "./modelo/usuario.php");
require "./modelo/conexion.php";

	
extract ($_REQUEST);
if (!isset($_REQUEST['x']))
	$_REQUEST['x']=0;

$objConexion=Conectarse();
$objUsuario = new Usuario();

$resultado=$objUsuario->consultarUsuario();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<title>Listar Usuarios:)</title>
</head>

<body>
<h1 class="display-4"> Lista Usuarios</h1>
<table class="table">
     <thead class="table-dark"> 
  <tr >
            <th scope="col">Identificacion Usuarios</th>
            <th scope="col">Nombre Docente</th>
            <th scope="col">Correo</th> <!-- Add columns for other properties -->
            <th scope="col">Telefono</th> <!-- Add columns for other properties -->
            <th scope="col">Contraseña</th>
            <th scope="col">Rol</th>
            

    <th scope="col">Editar</th>
     
    
    <th scope="col">Eliminar</th> 
  </tr>
  </thead>
  
  <?php
  //vamos agregar cada fila de la tabla de acuerdo al número de empleados de forma dinamica
  while ($Usuario = $resultado->fetch_object())
  {
	?>
	<tr bgcolor="c1c1c1">
  <td><?php echo $Usuario->Idusuarios ?> </td>
                <td><?php echo $Usuario->Nombre_apellido ?></td>
                <td><?php echo $Usuario->Correo ?></td>
                <td><?php echo $Usuario->Telefono ?></td>
                <td><?php echo $Usuario->Contraseña ?></td>
                <td><?php echo $Usuario->Rol ?></td>
                
        
        
        <td align="center"><a href="formActualizar.php?Idusuarios=<?php echo $Usuario->Idusuarios?>"><i class="fa-solid fa-user-pen" style="text-decoration:None;" width="29" height="24"></i></a></td>
        
        <td align="center"><a href="eliminarU.php?Idusuarios=<?php echo $Usuario->Idusuarios?>"><i class="fa-solid fa-eraser" style="text-decoration:None;" width="29" height="24" ></i></a></td>
  
    </tr>
  <?php
  }
  ?>
</table>

<button class="btn btn-success" onclick="window.location.href='form.php'">
    Agregar
    <i class="fa-solid fa-user-plus" style="text-decoration:None;" width="29" height="24"></i>
</button>

<p>
<?php

if ($_REQUEST['x']==5)
  echo "Se ha insertado el Empleado correctamente";
if ($_REQUEST['x']==6)
  echo "Problemas al insertar el Empleado";

?>
<table>
<tr>
    
</tr>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>