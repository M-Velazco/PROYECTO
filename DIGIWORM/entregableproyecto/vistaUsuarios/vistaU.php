<?php
// Asegúrate de incluir los archivos necesarios
require_once "../modelo/Usuario.php"; // Asegúrate de que la clase se llame "Usuario" y esté en un archivo llamado "Usuario.php"
require_once "../modelo/conexion.php";

// Crea una instancia de la conexión a la base de datos
$objConexion = Conectarse();

// Pasa la conexión a la base de datos al constructor de Usuario
$objUsuario = new Usuario($objConexion);
$resultado = $objUsuario->consultarUsuario();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listar Usuarios</title>
</head>

<body>
    <h1 align="center">LISTAR USUARIOS</h1>
    <table width="89%" border="0" align="center">
        <tr align="center" bgcolor="#ef7aec">
            <td width="5%">ID Usuario</td>
            <td width="10%">Nombre y Apellido</td>
            <td width="12%">Correo</td>
            <td width="7%">Teléfono</td>
            <td width="10%">Contraseña</td>
            <td width="10%">Rol</td>
        </tr>

        <?php
        while ($Usuario = $resultado->fetch_object()) {
            ?>
            <tr bgcolor="#8eefce" border="black">
                <td><?php echo $Usuario->Idusuarios ?></td>
                <td><?php echo $Usuario->Nombre_apellido ?></td>
                <td><?php echo $Usuario->Correo ?></td>
                <td><?php echo $Usuario->Telefono ?></td>
                <td><?php echo $Usuario->Contraseña ?></td>
                <td><?php echo $Usuario->Rol ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
