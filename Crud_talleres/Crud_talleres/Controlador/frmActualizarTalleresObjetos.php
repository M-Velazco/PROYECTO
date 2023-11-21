<?php
require "../Modelo/conexionBasesDatos.php";
require "../Modelo/Taller.php";
extract($_REQUEST);

$objConexion = Conectarse();

$sql = "SELECT * FROM talleres WHERE idtalleres = '$_REQUEST[idtalleres]'";
$resultadoTaller = $objConexion->query($sql);

$taller = $resultadoTaller->fetch_object();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Actualizar Taller</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="validarActualizarTalleresObjetos.php" enctype="multipart/form-data">
    <table width="42%" border="0" align="center">
        <tr>
            <td colspan="2" align="center" bgcolor="#FFCC00">ACTUALIZAR TALLER</td>
        </tr>
        <tr>
            <td width="37%" align="right" bgcolor="#EAEAEA">ID del Taller</td>
            <td width="63%"><label for="idtalleres"></label>
                <input name="idtalleres" type="text" id="idtalleres" value="<?php echo $taller->idtalleres ?>" readonly size="40" />
            </td>
        </tr>
        <tr>
            <td align="right" bgcolor="#EAEAEA">Nombre del Taller</td>
            <td><label for="Nom_taller"></label>
                <input name="Nom_taller" type="text" id="Nom_taller" value="<?php echo $taller->Nom_taller ?>" size="40" />
            </td>
        </tr>
        <tr>
            <td align="right" bgcolor="#EAEAEA">Materia del Taller</td>
            <td><label for="Materia_taller"></label>
                <input name="Materia_taller" type="text" id="Materia_taller" value="<?php echo $taller->Materia_taller ?>" size="40" />
            </td>
        </tr>
        <tr>
            <td align="right" bgcolor="#EAEAEA">Archivo Actual</td>
            <td>
                <?php echo $taller->Archivo; ?>
            </td>
        </tr>
        <tr>
            <td align="right" bgcolor="#EAEAEA">Nuevo Archivo</td>
            <td>
                <label for="Archivo"></label>
                <input name="Talleres" type="file" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#FFCC00"><input type="submit" name="button" id="button" value="Enviar" /></td>
        </tr>
    </table>

    <input name="Numero" type="hidden" value="<?php echo $_REQUEST['idtalleres'] ?>" size="40"/>
</form>
</body>
</html>
