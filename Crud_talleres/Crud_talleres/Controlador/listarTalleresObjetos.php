<?php
require "../Modelo/conexionBasesDatos.php";
require "../Modelo/Taller.php";

if (!isset($_REQUEST['x'])) {
    $_REQUEST['x'] = 0;
}

$objConexion = Conectarse();
$objTalleres = new Taller(); 

$resultado = $objTalleres->consultarTalleres();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Listar Talleres</title>
</head>

<body>
    <h1 align="center">LISTAR TALLERES</h1>
    <table width="89%" border="0" align="center">
        <tr align="center" bgcolor="#FFFF99">
            <td width="11%">ID del Taller</td>
            <td width="16%">Nombre del Taller</td>
            <td width="16%">Materia del Taller</td>
            <td width="16%">Docente</td>
            <td width="16%">Archivo</td>
            <td width="11%">Editar</td>
            <td width="11%">Eliminar</td>
        </tr>
        <?php while ($taller = $resultado->fetch_object()) { ?>
            <tr bgcolor="#CCCCFF">
                <td><?php echo $taller->idtalleres ?></td>
                <td><?php echo $taller->Nom_taller ?></td>
                <td><?php echo $taller->Materia_taller ?></td>
                <td><?php echo $taller->Docente ?></td>
                <td><?php echo $taller->Archivo ?></td>
                <td align="center"><a href="frmActualizarTalleresObjetos.php?idtalleres=<?php echo $taller->idtalleres ?>"><img src="../Imagenes/editar.jpg" width="29" height="24" /></a></td>
                <td align="center"><a href="eliminarTalleresObjetos.php?idtalleres=<?php echo $taller->idtalleres ?>"> <img src="../Imagenes/eliminar.jpg" width="29" height="24" /></a></td>
            </tr>
        <?php } ?>
    </table>
    <p>
        <?php
        if ($_REQUEST['x'] == 1) echo "Se ha agregado el Taller "; 
        if ($_REQUEST['x'] == 2) echo "Problemas al actualizar el Taller";
        if ($_REQUEST['x'] == 3) echo "Se ha eliminado el Taller correctamente";
        if ($_REQUEST['x'] == 4) echo "Problemas al eliminar el Taller";
        if ($_REQUEST['x'] == 5) echo "Se ha insertado el Taller correctamente";
        if ($_REQUEST['x'] == 6) echo "Problemas al insertar el Taller";
        if ($_REQUEST['x'] == 7) echo "Se ha Actualizado  el Taller "; 

        ?>
    </p>
    <table>
        <tr>
            <td align="center"><a href="Crud_talleres\vistaPrincipal.php">Menú Principal</a></td>
        </tr>
    </table>
</body>

</html>
