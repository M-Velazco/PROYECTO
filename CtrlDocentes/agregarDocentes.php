<?php
require("modeloDocentes/Docentes.php");
require("modeloDocentes/conexion.php");
$objconexion=Conectarse();
$objDocente=new Docentes($objconexion);
$resultado=$objDocente->consultarDocentes();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listar Docentes :)</title>
</head>

<body>
    <h1 align="center">Lista Docentes</h1>
    <table width="89%" border="0" align="center">
        <tr align="center" bgcolor="#FFFF99">
            <td width="10%">Identificación Docente</td>
            <td width="12%">Nombre y apellido Docente</td>
            <td width="12%">Correo Docente</td>
            <td width="12%">Contraseña Docente</td>
            <td width="12%">Curso_pr Docente</td>
            <td width="12%">Materia Docente</td>
            <td width="10%">Agregar</td> 
        </tr>
        
<?php 
while($Docente=$resultado->fetch_object()){
    ?>
            <tr bgcolor="#CCCCFF">
                <td><?php echo $Docente->iddocente?></td>
                <td><?php echo $Docente->Nombre_apellido ?></td>
                <td><?php echo $Docente->Correo ?></td>
                <td><?php echo $Docente->Contraseña ?></td>
                <td><?php echo $Docente->Curso_pr ?></td>
                <td><?php echo $Docente->Materia ?></td>
                <td align="center"><a href="frmagregarDocente.php?IDdocente=<?php echo $Docente->iddocente ?>">Agregar</a></td>
            </tr>
        <?php
}
        ?>
    </table>

    <p>
    <?php
    if (isset($_REQUEST['x'])) {
      
        if ($_REQUEST['x'] == 5)
            echo "Se ha insertado el docente correctamente";
        if ($_REQUEST['x'] == 6)
            echo "Problemas al insertar el docente";
    }
    ?>

    <table>
        <tr>
            <td align="center"><a href="../controlador/vistaPrincipal.php">Menú Principal</a></td>
        </tr>
    </table>
</body>
</html>
